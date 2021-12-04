<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealPostRequest;
use App\Models\Appeal;
use App\Sanitizers\DigitsOnlySanitizer;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $validated = $request->validate((new AppealPostRequest())->rules());

            $appeal = new Appeal();
            $appeal->name = $validated['name'];
            $appeal->surname = $validated['surname'];
            $appeal->patronymic = $validated['patronymic'];
            $appeal->age = $validated['age'];
            $appeal->gender = $validated['gender'];
            $appeal->phone = DigitsOnlySanitizer::sanitize($validated['phone']);
            $appeal->email = $validated['email'];
            $appeal->message = $validated['message'];
            $appeal->save();

            return redirect()
                ->route('appeal');
        }

        return view('appeal_view');
    }
}
