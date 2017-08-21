<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionnaireModel;
use Carbon\Carbon;
class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaire = QuestionnaireModel::get();

        return view('questionnaire.index', ['questionnaire'=>$questionnaire]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $today = Carbon::today();

        return view('questionnaire.add', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $questionnaire = new QuestionnaireModel($request->all());
       $questionnaire->save();
       return redirect()->route('questionnaire.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionnaire = QuestionnaireModel::find($id);
        return view('questionnaire.edit', compact('questionnaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $questionnaire = QuestionnaireModel::find($id);
        $questionnaire->question = $request->question;
        $questionnaire->date_create = $request->date_create;
        $questionnaire->save();
        return redirect('/questionnaire');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = QuestionnaireModel::find($id);
        $questionnaire->delete();
        return redirect('/questionnaire');
    }
}
