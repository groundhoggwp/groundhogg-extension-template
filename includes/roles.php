<?php
namespace GroundhoggExtension;

class Roles extends \Groundhogg\Roles
{

    /**
     * Returns an array  of role => [
     *  'role' => '',
     *  'name' => '',
     *  'caps' => []
     * ]
     *
     * In this case caps should just be the meta cap map for other WP related stuff.
     *
     * @return array[]
     */
    public function get_roles()
    {
        return [];
    }

    /**
     * Return a cap to check against the admin to ensure caps are also installed.
     *
     * @return mixed
     */
    protected function get_admin_cap_check()
    {
        // TODO: Implement get_admin_cap_check() method.
    }
}