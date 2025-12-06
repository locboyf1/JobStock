<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatBotSettingController extends Controller
{
    private $ruleFilePath;

    public function __construct()
    {
        $this->ruleFilePath = config('chatbot.RULES_PATH');
    }

    public function index()
    {
        if (Storage::exists($this->ruleFilePath)) {
            $rules = Storage::get($this->ruleFilePath);
        } else {
            $rules = '';
        }

        return view('admin.chatbot.index', ['rules' => $rules]);
    }

    public function update(Request $request)
    {
        $rules = $request->input('rules');
        Storage::put($this->ruleFilePath, $rules);

        return redirect()->route('admin.chatbotsetting.index')->with('success', 'Cập nhật thành công');
    }
}
