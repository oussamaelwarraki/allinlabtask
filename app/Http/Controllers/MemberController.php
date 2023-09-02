<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    public function index(Request $request): MemberCollection
    {
        $members = Member::all();

        return new MemberCollection($members);
    }

    public function store(MemberStoreRequest $request): MemberResource
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $member = Member::create($validatedData);
        return new MemberResource($member);
    }

    public function show(Request $request, Member $member): MemberResource
    {
        return new MemberResource($member);
    }

    public function update(MemberUpdateRequest $request, Member $member): MemberResource
    {
        $member->update($request->validated());

        return new MemberResource($member);
    }

    public function destroy(Request $request, Member $member): Response
    {
        $member->delete();

        return response()->noContent();
    }
}
