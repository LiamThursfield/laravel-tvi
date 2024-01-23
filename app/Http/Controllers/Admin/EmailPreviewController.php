<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Traits\Admin\Email\PreviewsMailables;
use Illuminate\Mail\Mailable;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailPreviewController extends AdminController
{
    use PreviewsMailables;

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Email Preview');
    }

    public function index(): Response
    {
        $this->shareMeta();

        return Inertia::render('admin/email/preview/Index', [
            'mailables' => $this->getMailablePreviewUrls(),
        ]);
    }

    public function show($email): Mailable
    {
        $mailable = $this->getMailable($email);

        if (!$mailable) {
            throw new NotFoundHttpException('Unable to find email to preview: ' . $email);
        }

        return $mailable;
    }
}
