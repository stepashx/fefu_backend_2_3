<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $errors = [];
        $success = $request->session()->get('success', false);
        $unfilled_field_error = 'Unfilled field';

        if ($request->isMethod('post'))
        {
            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $message = $request->input('message');

            if ($name === null) {
                $errors['name'] = $unfilled_field_error;
            }
            if ($phone === null && $email === null) {
                $errors['phone'] = $unfilled_field_error;
                $errors['email'] = $unfilled_field_error;
            }
            if ($message === null) {
                $errors['message'] = $unfilled_field_error;
            }


            if (count($errors) > 0) {
                $request->flash();
            } else {
                $appeal = new Appeal();
                $appeal->name = $name;
                $appeal->phone = $phone;
                $appeal->email = $email;
                $appeal->message = $message;
                $appeal->save();

                $success = true;

                return redirect()
                    ->route('appeal')
                        ->with('success', $success);
            }
        }

        return view('appeal_view', ['errors' => $errors, 'success' => $success]);
    }
}
