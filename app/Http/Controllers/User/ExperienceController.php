<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Experience\CreateRequest;
use App\Http\Requests\User\Experience\UpdateRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
class ExperienceController extends Controller
{
    public function index()
    {
        return ExperienceResource::collection(Experience::all());
    }

    public function store(CreateRequest $request)
    {
        $experience = Experience::create($request->validated());
        return ExperienceResource::make($experience);
    }

    public function show(Experience $experience)
    {
        return ExperienceResource::make($experience);
    }

    public function update(UpdateRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return ExperienceResource::make($experience->refresh());
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return response()->json(null, 204);
    }
}
