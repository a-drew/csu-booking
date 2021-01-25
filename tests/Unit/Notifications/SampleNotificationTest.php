<?php

namespace Tests\Unit\Notifications;

use App\Notifications\SampleNotification;
use PHPUnit\Framework\TestCase;

class SampleNotificationTest extends TestCase
{

    public function testToVia()
    {
        $notification = new SampleNotification();
        $via = $notification->via(null);
        $this->assertEquals(['mail', 'database'], $via);
    }

    public function testToMail()
    {
        $notification = new SampleNotification();
        $mail = $notification->toMail(null);
        $this->assertEquals('Notification Action', $mail->actionText);
    }

    public function testToArray()
    {
        $notification = new SampleNotification();
        $arr = $notification->toArray(null);
        $this->assertEquals([], $arr);
    }
}
