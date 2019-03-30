import UserBase from "./views/UserBase";
import Users from "./views/Users";
import User from "./views/User";

export default [
    {
        path: '/portal/admin/users',
        component: UserBase,
        children: [
            {
                path: '',
                name: 'portal-admin-users',
                component: Users
            },
            {
                path: ':id',
                name: 'portal-admin-user',
                component: User
            }
        ],
        meta: {
            requiresAuth: true
        }
    }
];
