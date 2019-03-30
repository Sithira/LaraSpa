import CheckupBase from "./views/CheckupBase";
import Checkups from "./views/Checkups";
import Checkup from "./views/Checkup";

export default [
    {
        path: '/portal/admin/checkups',
        component: CheckupBase,
        children: [
            {
                path: '',
                name: 'portal-admin-checkups',
                component: Checkups,
            },
            {
                path: ':id',
                name: 'portal-admin-checkup',
                component: Checkup
            }
        ]
    }
];
