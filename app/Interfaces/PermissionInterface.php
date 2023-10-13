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
    // Admin Permissions
    const VIEW_ADMIN = 'view admin';

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
    const PUBLISH_EDU_COURSES    = 'publish edu_courses';

    // EDU Programmes Permissions
    const CREATE_EDU_PROGRAMMES  = 'create edu_programmes';
    const DELETE_EDU_PROGRAMMES  = 'delete edu_programmes';
    const EDIT_EDU_PROGRAMMES    = 'edit edu_programmes';
    const VIEW_EDU_PROGRAMMES    = 'view edu_programmes';
    const PUBLISH_EDU_PROGRAMMES    = 'publish edu_programmes';

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
    const PUBLISH_EDU_ANNOUNCEMENTS = 'publish edu_announcements';

    // EDU Webinars Permissions
    const CREATE_EDU_WEBINARS  = 'create edu_webinars';
    const DELETE_EDU_WEBINARS  = 'delete edu_webinars';
    const EDIT_EDU_WEBINARS    = 'edit edu_webinars';
    const VIEW_EDU_WEBINARS    = 'view edu_webinars';

    // EDU Purchases Permissions
    const CREATE_EDU_PURCHASES  = 'create edu_purchases';
    const DELETE_EDU_PURCHASES  = 'delete edu_purchases';
    const EDIT_EDU_PURCHASES    = 'edit edu_purchases';
    const VIEW_EDU_PURCHASES    = 'view edu_purchases';

    // File Manager Permissions
    const EDIT_FILE_MANAGER = 'edit file_manager';
    const VIEW_FILE_MANAGER = 'view file_manager';

    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // Setting Permissions
    const EDIT_SETTINGS = 'edit settings';
    const VIEW_SETTINGS = 'view settings';

    // Telescope Permissions
    const VIEW_TELESCOPE = 'view telescope';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // Student Admin Permissions
    const VIEW_STUDENT_ADMIN = 'view student_admin';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'admin' => [
            'view' => self::VIEW_ADMIN,
        ],
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
        'edu_announcements' => [
            'create' => self::CREATE_EDU_ANNOUNCEMENTS,
            'delete' => self::DELETE_EDU_ANNOUNCEMENTS,
            'edit' => self::EDIT_EDU_ANNOUNCEMENTS,
            'view' => self::VIEW_EDU_ANNOUNCEMENTS,
            'publish' => self::PUBLISH_EDU_ANNOUNCEMENTS,
        ],
        'edu_courses' => [
            'create' => self::CREATE_EDU_COURSES,
            'delete' => self::DELETE_EDU_COURSES,
            'edit' => self::EDIT_EDU_COURSES,
            'view' => self::VIEW_EDU_COURSES,
            'publish' => self::PUBLISH_EDU_COURSES,
        ],
        'edu_programmes' => [
            'create' => self::CREATE_EDU_PROGRAMMES,
            'delete' => self::DELETE_EDU_PROGRAMMES,
            'edit' => self::EDIT_EDU_PROGRAMMES,
            'view' => self::VIEW_EDU_PROGRAMMES,
            'publish' => self::PUBLISH_EDU_PROGRAMMES,
        ],
        'edu_labels' => [
            'create' => self::CREATE_EDU_LABELS,
            'delete' => self::DELETE_EDU_LABELS,
            'edit' => self::EDIT_EDU_LABELS,
            'view' => self::VIEW_EDU_LABELS,
        ],
        'edu_sections' => [
            'create' => self::CREATE_EDU_SECTIONS,
            'delete' => self::DELETE_EDU_SECTIONS,
            'edit' => self::EDIT_EDU_SECTIONS,
            'view' => self::VIEW_EDU_SECTIONS,
        ],
        'edu_lectures' => [
            'create' => self::CREATE_EDU_LECTURES,
            'delete' => self::DELETE_EDU_LECTURES,
            'edit' => self::EDIT_EDU_LECTURES,
            'view' => self::VIEW_EDU_LECTURES,
        ],
        'edu_webinars' => [
            'create' => self::CREATE_EDU_WEBINARS,
            'delete' => self::DELETE_EDU_WEBINARS,
            'edit' => self::EDIT_EDU_WEBINARS,
            'view' => self::VIEW_EDU_WEBINARS,
        ],
        'edu_purchases' => [
            'create' => self::CREATE_EDU_PURCHASES,
            'delete' => self::DELETE_EDU_PURCHASES,
            'edit' => self::EDIT_EDU_PURCHASES,
            'view' => self::VIEW_EDU_PURCHASES,
        ],
        'file_manager' => [
            'edit' => self::EDIT_FILE_MANAGER,
            'view' => self::VIEW_FILE_MANAGER,
        ],
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'settings' => [
            'edit' => self::EDIT_SETTINGS,
            'view' => self::VIEW_SETTINGS,
        ],
        'telescope' => [
            'view'  => self::VIEW_TELESCOPE
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ],

        'student_admin' => [
            'view' => self::VIEW_STUDENT_ADMIN,
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
