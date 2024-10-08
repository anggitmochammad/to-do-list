<?php

namespace App\Http\Controllers;

use App\Enums\ItemStatus;
use App\Http\Requests\ChecklistItemRequest;
use App\Http\Requests\CheckListItemUpdateRequest;
use App\Http\Resources\ChecklistItemResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;

class ChecklistItemController extends Controller
{

    public function index()
    {

    }

    public function store(Checklist $checklist, ChecklistItemRequest $request)
    {
        $checklistItem = ChecklistItem::create([
            'checklist_id' => $checklist['id'],
            'status' => ItemStatus::TODO,
        ] + $request->only(['title']));

        return ChecklistItemResource::make($checklistItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(checklist $checklist, Checklistitem $checklistItem,)
    {
        return ChecklistItemResource::make($checklistItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(checklist $checklist, Checklistitem $checklistItem, CheckListItemUpdateRequest $request)
    {
        $checklistItem->update($request->only('status'));

        return ChecklistItemResource::make($checklistItem);

    }

    public function updateName(checklist $checklist, Checklistitem $checklistItem, CheckListItemUpdateRequest $request)
    {
        $checklistItem->update($request->only('title'));

        return ChecklistItemResource::make($checklistItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checklist $checklist, Checklistitem $checklistItem, CheckListItemUpdateRequest $request)
    {
        $checklistItem->delete();
        return $this->successResponse('Checklist berhasil dihapus');
    }
}
