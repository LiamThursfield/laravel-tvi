<?php

namespace App\Interfaces;

/**
 * Interface to define core system Permissions
 *
 * When adding a new Permission:
 *      - Add a new const for the permission
 *          - For the name: use the format {ACTION}_{SUBJECT} e.g. VIEW_USERS
 *          - For the value: Use the format {action} {subject} e.g. view users
 *
 *      - Add the permission to the ALL_PERMISSIONS const
 *          - Use the format {subject} => [{action} => {permission constant}] e.g. 'users' => ['view' => self::VIEW_USERS]
 *
 */
class PermissionInterface
{
    // CMS Permissions
    const CREATE_CMS  = 'create cms';
    const DELETE_CMS  = 'delete cms';
    const EDIT_CMS    = 'edit cms';
    const VIEW_CMS    = 'view cms';

    // Advanced CMS Permissions
    const CREATE_CMS_ADVANCED  = 'create cms_advanced';
    const DELETE_CMS_ADVANCED  = 'delete cms_advanced';
    const EDIT_CMS_ADVANCED    = 'edit cms_advanced';
    const VIEW_CMS_ADVANCED    = 'view cms_advanced';

    // CRM Contacts Permissions
    const CREATE_CRM_CONTACTS    = 'create crm_contacts';
    const DELETE_CRM_CONTACTS    = 'delete crm_contacts';
    const EDIT_CRM_CONTACTS      = 'edit crm_contacts';
    const VIEW_CRM_CONTACTS      = 'view crm_contacts';

    // CRM Form Submission Permissions
    const VIEW_CRM_FORM_SUBMISSIONS = 'view crm_form_permissions';

    // CRM Forms Permissions
    const CREATE_CRM_FORMS    = 'create crm_forms';
    const DELETE_CRM_FORMS    = 'delete crm_forms';
    const EDIT_CRM_FORMS      = 'edit crm_forms';
    const VIEW_CRM_FORMS      = 'view crm_forms';

    // CRM Organisation Unit Permissions
    const CREATE_CRM_ORGANISATION_UNITS    = 'create crm_organisation_units';
    const DELETE_CRM_ORGANISATION_UNITS    = 'delete crm_organisation_units';
    const EDIT_CRM_ORGANISATION_UNITS      = 'edit crm_organisation_units';
    const VIEW_CRM_ORGANISATION_UNITS      = 'view crm_organisation_units';

    // EDU Course Permissions
    const CREATE_EDU_COURSES  = 'create edu_courses';
    const DELETE_EDU_COURSES  = 'delete edu_courses';
    const EDIT_EDU_COURSES    = 'edit edu_courses';
    const VIEW_EDU_COURSES    = 'view edu_courses';

    // EDU Programs Permissions
    const CREATE_EDU_PROGRAMMES  = 'create edu_programmes';
    const DELETE_EDU_PROGRAMMES  = 'delete edu_programmes';
    const EDIT_EDU_PROGRAMMES    = 'edit edu_programmes';
    const VIEW_EDU_PROGRAMMES    = 'view edu_programmes';

    // EDU Labels Permissions
    const CREATE_EDU_LABELS  = 'create edu_labels';
    const DELETE_EDU_LABELS  = 'delete edu_labels';
    const EDIT_EDU_LABELS    = 'edit edu_labels';
    const VIEW_EDU_LABELS    = 'view edu_labels';

    // EDU Sections Permissions
    const CREATE_EDU_SECTIONS  = 'create edu_sections';
    const DELETE_EDU_SECTIONS  = 'delete edu_sections';
    const EDIT_EDU_SECTIONS    = 'edit edu_sections';
    const VIEW_EDU_SECTIONS    = 'view edu_sections';

    // EDU Lectures Permissions
    const CREATE_EDU_LECTURES  = 'create edu_lectures';
    const DELETE_EDU_LECTURES  = 'delete edu_lectures';
    const EDIT_EDU_LECTURES    = 'edit edu_lectures';
    const VIEW_EDU_LECTURES    = 'view edu_lectures';

    // EDU Announcements Permissions
    const CREATE_EDU_ANNOUNCEMENTS  = 'create edu_announcements';
    const DELETE_EDU_ANNOUNCEMENTS  = 'delete edu_announcements';
    const EDIT_EDU_ANNOUNCEMENTS    = 'edit edu_announcements';
    const VIEW_EDU_ANNOUNCEMENTS    = 'view edu_announcements';

    // EDU Announcements Permissions
    const CREATE_EDU_WEBINARS  = 'create edu_webinars';
    const DELETE_EDU_WEBINARS  = 'delete edu_webinars';
    const EDIT_EDU_WEBINARS    = 'edit edu_webinars';
    const VIEW_EDU_WEBINARS    = 'view edu_webinars';

    // File Manager Permissions
    const EDIT_FILE_MANAGER = 'edit file_manager';
    const VIEW_FILE_MANAGER = 'view file_manager';

    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // Telescope Permissions
    const VIEW_TELESCOPE = 'view telescope';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'cms' => [
            'create'    => self::CREATE_CMS,
            'delete'    => self::DELETE_CMS,
            'edit'      => self::EDIT_CMS,
            'view'      => self::VIEW_CMS,
        ],
        'cms_advanced' => [
            'create'    => self::CREATE_CMS_ADVANCED,
            'delete'    => self::DELETE_CMS_ADVANCED,
            'edit'      => self::EDIT_CMS_ADVANCED,
            'view'      => self::VIEW_CMS_ADVANCED,
        ],
        'crm_contacts' => [
            'create'    => self::CREATE_CRM_CONTACTS,
            'delete'    => self::DELETE_CRM_CONTACTS,
            'edit'      => self::EDIT_CRM_CONTACTS,
            'view'      => self::VIEW_CRM_CONTACTS,
        ],
        'crm_form_submissions' => [
            'view'  => self::VIEW_CRM_FORM_SUBMISSIONS,
        ],
        'crm_forms' => [
            'create'    => self::CREATE_CRM_FORMS,
            'delete'    => self::DELETE_CRM_FORMS,
            'edit'      => self::EDIT_CRM_FORMS,
            'view'      => self::VIEW_CRM_FORMS,
        ],
        'crm_organisation_units' => [
            'create'    => self::CREATE_CRM_ORGANISATION_UNITS,
            'delete'    => self::DELETE_CRM_ORGANISATION_UNITS,
            'edit'      => self::EDIT_CRM_ORGANISATION_UNITS,
            'view'      => self::VIEW_CRM_ORGANISATION_UNITS,
        ],
        'edu_courses' => [
            'create' => self::CREATE_EDU_COURSES,
            'delete' => self::DELETE_EDU_COURSES,
            'edit' => self::EDIT_EDU_COURSES,
            'view' => self::VIEW_EDU_COURSES,
        ],
        'edu_programmes' => [
            'create' => self::CREATE_EDU_PROGRAMMES,
            'delete' => self::DELETE_EDU_PROGRAMMES,
            'edit' => self::EDIT_EDU_PROGRAMMES,
            'view' => self::VIEW_EDU_PROGRAMMES,
        ],
        'edu_labels' => [
            'create' => self::CREATE_EDU_LABELS,
            'delete' => self::DELETE_EDU_LABELS,
            'edit' => self::EDIT_EDU_LABELS,
            'view' => self::VIEW_EDU_LABELS,
        ],
        'file_manager' => [
            'edit' => self::EDIT_FILE_MANAGER,
            'view' => self::VIEW_FILE_MANAGER,
        ],
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'telescope' => [
            'view'  => self::VIEW_TELESCOPE
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ]
    ];

    static function getMiddlewareString($permissions)
    {
        if (is_array($permissions)) {
            $permissions = implode(',', $permissions);
        }

        return 'can:' . $permissions;
    }
}
