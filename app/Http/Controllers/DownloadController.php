<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;

class DownloadController extends Controller
{
   public function aadharConsent(Request $request)
   {
            $destination = public_path('assets/documents/Aadhar Consent.pdf');
        	session::flash("message","Fil has been downloaded");
            return Response::download( $destination,'Aadhar Consent.pdf',[],'attachment');
   }

   public function RRIndividualAppFormv1(Request $request)
   {
            $destination = public_path('assets/documents/R&R Individual App Form- v 1.pdf');
        	session::flash("message","Fil has been downloaded");
            return Response::download( $destination,'R&R Individual App Form- v 1.pdf',[],'attachment');
   }
}
