import CheckupScheduleBase from "./view/CheckupScheduleBase";
import CheckupSchedules from "./view/CheckupSchedules";
import CheckupSchedule from "./view/CheckupSchedule";

export default [
    {
        path: '/portal/admin/checkup-schedules',
        component: CheckupScheduleBase,
        children: [
            {
                path: '',
                name: 'portal-admin-schedules',
                component: CheckupSchedules
            },
            {
                path: ':id',
                name: 'portal-admin-schedule',
                component: CheckupSchedule
            }
        ]
    }
]
