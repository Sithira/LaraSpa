import UserIndexComponent from "./views/UserIndexComponent";
import UsersComponent from "./views/UsersComponent";
import UserComponent from "./views/UserComponent";

export default [
    {
        path: '/portal/admin/users',
        component: UserIndexComponent,
        children: [
            {
                path: '',
                name: 'portal-admin-users',
                component: UsersComponent
            },
            {
                path: ':id',
                name: 'portal-admin-user',
                component: UserComponent
            }
        ],
        meta: {
            requiresAuth: true
        }
    }
];
