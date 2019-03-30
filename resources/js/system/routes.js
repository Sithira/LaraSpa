import Portal from "./views/Portal";

import PortalAdminUserRoutes from "./modules/portal/admin/users/routes";
import PortalAdminCheckupsRoutes  from "./modules/portal/admin/checkups/routes";

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

export default baseRoutes.concat(PortalAdminUserRoutes, PortalAdminCheckupsRoutes);
