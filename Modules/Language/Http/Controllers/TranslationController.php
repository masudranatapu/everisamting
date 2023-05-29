<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Ui\Presets\React;
use Modules\Language\Entities\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationController extends Controller
{
    public function __construct()
    {
        abort_if(!enableModule('language'), 404);
    }

    public function transUpdate(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $language = Language::findOrFail($request->lang_id);
        $data = file_get_contents(base_path('resources/lang/en.json'));

        $translations = json_decode($data, true);

        foreach ($translations as $key => $value) {
            if ($request->$key) {
                $translations[$key] = $request->$key;
            } else {
                $translations[$key] = $value ?? '';
            }
        }

        $updated = file_put_contents(base_path('resources/lang/' . $language->code . '.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        $updated ? flashSuccess('Translations updated successfully') : flashError();
        return back();
    }

    public function autoTransSingle(Request $request)
    {

        $text = autoTransLation($request->lang, $request->text);
        return response()->json($text);
    }

    public function transUpdateAutoAll(Request $request)
    {

        $language = Language::findOrFail($request->lang);
        $data = file_get_contents(base_path('resources/lang/' . $language->code . '.json'));
        $translations = json_decode($data, true);

        $afterTrans = [];
        $tr = new GoogleTranslate($language->code);
        foreach ($translations as $key => $value) {

            $autoTransValue = $tr->translate($value);
            $afterTrans[$key] = $autoTransValue;
        }

        // flashSuccess('Translations updated successfully');
        return response()->json(['data' => $afterTrans]);
    }

    public function langView($code)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $path = base_path('resources/lang/' . $code . '.json');
        $language = Language::where('code', $code)->first();
        $translations = json_decode(file_get_contents($path), true);

        return view('language::lang_view', compact('language', 'translations'));
    }

    public function changeLanguage($lang)
    {
        session()->put('set_lang', $lang);
        app()->setLocale($lang);

        return back();
    }

    public function setDefaultLanguage(Request $request)
    {
        if (env('APP_DEFAULT_LANGUAGE') != $request->code) {
            envReplace('APP_DEFAULT_LANGUAGE', $request->code);
        }

        if (session()->get('set_lang') != $request->code) {
            session()->put('set_lang', $request->code);
            app()->setLocale($request->code);
        }

        return back()->with('success', 'Default Language Added Successfull');
    }
}
