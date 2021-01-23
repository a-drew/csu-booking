<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
        'floor',
        'building',
        'status', 
        'min_days_advance',
        'max_days_advance',
        'attributes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attributes' => 'array',
    ];

    /**
     * The roles restricted from this room.
     */
    public function restrictions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'room_restrictions');
    }

    /**
     * Get the booking requests for the room.
     */
    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }

    /**
     * Get the availabilities for the room
     */
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * Check the availability of the room.
     */
    public function scopeAvailable(Builder $q)
    {
        $q->where('status', 'available');
    }

    /**
     * Hide rooms restricted by the user's roles
     */
    public function scopeHideUserRestrictions(Builder $q, User $u)
    {
        $q->whereNotIn('id', $u->roles()->with('restrictions')->get()
            ->pluck('restrictions')->flatten()->pluck('id')->unique()->toArray());
    }

    /**
     * Check if start date and end date is within room availabilities
     * @param $startDate is a date time string
     * @param $endDate is a date time string
     * @return void
     * @throws ValidationException
     */
    public function verifyDatetimesAreWithinAvailabilities($startDate, $endDate)
    {
        $startTime = Carbon::parse($startDate)->toTimeString();
        $endTime = Carbon::parse($endDate)->toTimeString();

        $availabilityStart =
            Availability::where('weekday', Carbon::parse($startDate)->format('l'))
                ->where('room_id', '=', $this->id)->first();

        $availabilityEnd =
            Availability::where('weekday', Carbon::parse($endDate)->format('l'))
                ->where('room_id', '=', $this->id)->first();

        if (
            empty($availabilityStart) ||
            empty($availabilityEnd) ||
            $startTime < $availabilityStart->opening_hours ||
            $endTime > $availabilityEnd->closing_hours
        ) {
            throw ValidationException::withMessages([
                'availabilities' => 'Booking request not within availabilities!'
            ]);
        }
    }
    public function verifyDatesAreWithinRoomRestrictions($startDate)
    {
        $startTime = Carbon::parse($startDate)->toDateString();
        $min_days = $this->min_days_advance;
        $max_days = $this->max_days_advance;

        if(Carbon::today()-> diffInDays($startTime) < $min_days) {
            throw ValidationException::withMessages(['booked_too_close' => 'You can not book events closer than ' .$min_days.' days to the event']);
        } elseif(Carbon::today()-> diffInDays($startTime) > $max_days) {
            throw ValidationException::withMessages(['booked_too_far' => 'You cannot book events farther than '.$max_days.' days from the event']);
        }
    }
}