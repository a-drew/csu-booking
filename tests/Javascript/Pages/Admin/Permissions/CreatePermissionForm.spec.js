import Vue from 'vue'
import {mount, shallowMount} from '@vue/test-utils'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaForm } from 'laravel-jetstream'
import CreatePermissionForm from '../../../../../resources/js/Pages/Admin/Permissions/CreatePermissionForm'
import {test} from "@jest/globals";
import CreateRoleForm from "../../../../../resources/js/Pages/Admin/Roles/CreateRoleForm";

Vue.use(InertiaApp)
Vue.use(InertiaForm)

//This is an example, please do more than just test if it crashes :p
test('should mount without crashing', () => {
    const wrapper = mount(CreateRoleForm, {
        data() {
            return {
                form: {
                    hasErrors(bag) {
                        return false;
                    },
                    error(name) {
                        return "";
                    }
                }
            }
        }
    })

    expect(wrapper.text()).toBeDefined()
})
