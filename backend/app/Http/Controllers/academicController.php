<?php

namespace App\Http\Controllers;

use App\Http\Requests\academicValidation;
use Illuminate\Http\Request;
use App\Models\academic;
use App\Models\academicStoreModel;
use Illuminate\Support\Facades\Validator;


class academicController extends Controller
{

    public function store(academicValidation $request)
    {
        $validated=$request->validate();

        $academics = new academicStoreModel;
        $academics->email=$validated['email'];
        $academics->board = $validated['X_Board'];
        $academics->X_year = $validated['X_year'];
        $academics->X_State = $validated['X_State'];
        $academics->X_Marks = $validated['X_Marks'];
        $academics->XI_Board = $validated['Xi_Board'];
        $academics->XI_year = $validated['Xi_year'];
        $academics->XI_State = $validated['X_State'];
        $academics->XI_Marks = $validated['X_Marks'];
        $academics->XII_Board = $validated['Xii_board'];
        $academics->XII_year = $validated['Xii_year'];
        $academics->XII_State = $validated['Xii_State'];
        $academics->XII_Marks = $validated['Xii_Marks'];
        $academics->save();

        return response()->json([
            'success' => 'Academic Details Added Successfully'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {

        $formData = academic::all();
        foreach ($formData as $form) {
            $a[$form->children_class][$form->parentClassName][] = $form;
        }
        return response()->json([
            'data' => $a
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
