<?php

namespace App\Http\Controllers;

use App\Jobs\FirstPostNotificationJob;
use Illuminate\Http\Request;
use App\Models\MrgeJob;
use App\Models\MrgeJobDescription;

class MrgeJobController extends Controller
{

        /**
    * Display a listing of the resource.
    *
    * @return Response
    */  
    public function index()
    {
        $mrgeJobs = MrgeJob::orderBy('createdAt', 'desc')->with('descriptions')->get();
        return response()->json(['data' => $mrgeJobs]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function updateMrgeJobsFromExternalApi()
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
        // Retrieve and parse external data
        $externalJobs = file_get_contents(config('app.externalJobsApiEndpoint'), false, stream_context_create($arrContextOptions));
        $xmlJobs = simplexml_load_string($externalJobs, 'SimpleXMLElement', LIBXML_NOCDATA);
        $jsonJobs = json_encode($xmlJobs);
        $arrayJobs = json_decode($jsonJobs);

        if (!$arrayJobs->position) {
            return;
        }

        if (is_object($arrayJobs->position)) {
            $this->addMrgeJobs($arrayJobs->position);
        }

        if (is_array($arrayJobs->position)) {
            foreach ($arrayJobs->position as $job) {
                $this->addMrgeJobs($job);
            }
        }
    }

    /**
    * Store a newly created jobs in storage.
    *
    * @return Response
    */
    protected function addMrgeJobs(object $job)
    {
        // Check if email exists
        $checkJobEmail = MrgeJob::where('email', $job->email ?? null)->first();

        $newJob = MrgeJob::updateOrCreate(
            [
                'external_id' => $job->id
            ],
            [
                'external_id'           => $job->id,
                'name'                  => $job->name,
                'email'                 => $job->email ?? null,
                'subcompany'            => $job->subcompany ?? null,
                'office'                => $job->office ?? null,
                'department'            => $job->department ?? null,
                'recruitingCategory'    => $job->recruitingCategory ?? null,
                'employmentType'        => $job->employmentType ?? null,
                'seniority'             => $job->seniority ?? null,
                'schedule'              => $job->schedule ?? null,
                'yearsOfExperience'     => $job->yearsOfExperience ?? null,
                'keywords'              => $job->keywords ?? null,
                'occupation'            => $job->occupation ?? null,
                'occupationCategory'    => $job->occupationCategory ?? null,
                'createdAt'             => date('Y-m-d H:i:s', strtotime($job->createdAt)),
            ]
        );

        MrgeJobDescription::where('mrge_job_id', $newJob->id)->delete();

        foreach ($job->jobDescriptions->jobDescription as $jobDescription) {
            MrgeJobDescription::create([
                'name' => $jobDescription->name,
                'value' => $jobDescription->value,
                'mrge_job_id' => $newJob->id,
            ]);
        }
        
        // Check if this is the user's first job post
        if (!$checkJobEmail && !empty($job->email)) {
            $this->sendNotificationEmail($newJob);
        }
    }


    /**
    * Approve the job based on id.
    *
    * @return Response
    */  
    public function approve(int $id)
    {
        $mrgeJobs = MrgeJob::where('id', $id)
            ->update([
                'status' => 'approved'
            ]);
        
        return response()->json(['data' => 'Has been marked as approved']);
    }

    /**
    * Mark job as notApprove/Spam the job based on id.
    *
    * @return Response
    */  
    public function mark_as_spam(int $id)
    {
        MrgeJob::where('id', $id)
            ->update([
                'status' => 'notApproved'
            ]);
        
        return response()->json(['data' => 'Has been marked as notApproved']);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
        ]);

        // Check if email exists
        $checkJobEmail = MrgeJob::where('email', $validated['email'])->first();

        // Create the job
        $job = MrgeJob::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'subcompany'            => $request->subcompany,
            'department'            => $request->department,
            'employmentType'        => $request->employmentType,
            'keywords'              => $request->keywords,
            'occupation'            => $request->occupation,
            'occupationCategory'    => $request->occupationCategory,
            'office'                => $request->office,
            'recruitingCategory'    => $request->recruitingCategory,
            'schedule'              => $request->schedule,
            'yearsOfExperience'     => $request->yearsOfExperience,
            'createdAt'             => date('Y-m-d H:i:s'),
        ]);
        
        foreach ($request->items as $jobDescription) {
            if (empty($jobDescription['name']) && empty($jobDescription['description'])) {
                continue;
            }
            MrgeJobDescription::create([
                'name' => $jobDescription['name'],
                'value' => $jobDescription['description'],
                'mrge_job_id' => $job->id,
            ]);
        }

        // Check if this is the user's first job post
        if (! $checkJobEmail) {
            $this->sendNotificationEmail($job);
        }

        return response()->json($job);
    }

    /**
    * Send email notification.
    *
    */
    protected function sendNotificationEmail($job)
    {
        FirstPostNotificationJob::dispatch($job);
    }
}
