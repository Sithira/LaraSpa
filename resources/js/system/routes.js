import Portal from "./views/Portal";

import PortalAdminUserRoutes from "./modules/portal/admin/users/routes";

const baseRoutes = [
    {
        path: '/portal',
        name: 'portal-home',
        component: Portal,
        meta: {
            requiresAuth: true
        }
    }
];

export default baseRoutes.concat(PortalAdminUserRoutes);
