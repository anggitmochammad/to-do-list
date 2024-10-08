<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistResource;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = QueryBuilder::for(Checklist::where('user_id', Auth::user()['id']))->paginate(15);

        return ChecklistResource::collection($checklists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChecklistRequest $request)
    {
        $checklist = Checklist::create([
            'user_id' => Auth::user()['id']
        ] + $request->only(['title', 'description']));

        return ChecklistResource::make($checklist);
    }

    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist)
    {
        $checklist = $checklist->load([
                'items'
            ]);

        return ChecklistResource::make($checklist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return $this->successResponse('Checklist berhasil dihapus');
    }
}
