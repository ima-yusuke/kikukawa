<x-dash-layout>
    <div class="flexColumn items-center gap-16 py-10">
        {{--現在の一覧表示--}}
        <section class="w-[90%] flexColumn gap-8 sm:rounded-lg">
            <x-dash-title title="社員インタビュー 一覧" en="Interview List"></x-dash-title>
            <div class="overflow-y-auto overflow-x-auto h-600 ">
                <table class="whitespace-nowrap w-[95%] shadow-md text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center text-sm">
                        <th scope="col" class="px-2 py-3 _sticky_ab">
                            編集
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_ab2">
                            削除
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_b">
                            氏名
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_b">
                            プロフィール画像①
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_b">
                            プロフィール画像②
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_b">
                            最終学歴
                        </th>
                        <th scope="col" class="px-2 py-3 _sticky_b">
                            入社年/職種
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            タイトル
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            入社のきっかけ
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            仕事のやりがい
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            日々、意識していること
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            今後の目標
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            就職活動中の皆さんへ
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            1日のスケジュール
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            キャリアパス
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            休日の過ごし方
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($interviews as $key=>$value)
                        {{-- 最初表示されるtr--}}
                        <tr class="h-64 text-xs originalTr bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 _sticky_a text-gray-700 uppercase bg-gray-50">
                                <div class="flexCenter">
                                    <a class="text-center editBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">編集</a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteInterview({{ $value['id'] }})">削除</button>
                                </div>
                            </td>
                            {{--<livewire:interview-livewire :id="$value->id"></livewire:interview-livewire>--}}
                            <td class="text-center px-6 py-4 w-[5%] ">
                                <div class="flexCenter">{{$value["name"]}}</div>
                            </td>
                            <td class="text-center px-2 py-4 w-100">
                                <img src="{{asset($value->path_1)}}" class="rounded-8 shrink-0 object-cover">
                            </td>
                            <td class="text-center px-2 py-4 w-100">
                                <img src="{{asset($value->path_2)}}" class="rounded-8 shrink-0 object-cover">
                            </td>
                            <td class="text-center px-2 py-4 w-150 ">
                                <p>{{$value["school"]}}</p>
                                <p>{{$value["department"]!=null?$value["department"]:null}}</p>
                                <p>{{$value["faculty"]!=null?$value["faculty"]:null}}</p>
                            </td>
                            <td class="text-center px-6 py-4 w-150">
                                <p>{{$value["hire_year"]}}入社</p>
                                <p>{{$value["job_dpt"]}}</p>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["title"]}} </div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_1"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_2"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_3"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_4"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_5"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-pre">
                                <div class="flexCenter">{{$value["question_6"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-pre">
                                <div class="flexCenter">{{$value["question_7"]}}</div>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">
                                <div class="flexCenter">{{$value["question_8"]}}</div>
                            </td>
                        </tr>

                        {{--hidden (編集用tr)--}}
                        <tr class="h-64 editTr text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <form method="post" action="{{route('update-interview',$value)}}" enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <td class="px-6 py-4 _sticky_a ">
                                    <x-dashboard_btn></x-dashboard_btn>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flexCenter">
                                        <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteInterview({{ $value['id'] }})">削除</button>
                                    </div>
                                </td>
                                {{--<livewire:interview-livewire :id="$value->id"></livewire:interview-livewire>--}}

                                <td class="px-6 py-4"><input class="text-xs text-dashInputColor" type="text" name="name" value="{{$value["name"]}}" required></td>
                                <td class="px-6 py-4">
                                    <div class="flexColumnCenter gap-2">
                                        <label class="py-2 px-4 bg-black hover:cursor-pointer">
                                            <input type="file" accept="image/jpeg,image/png" name="path_1" class="imgInput hidden">
                                            <i class="iconDefault fa-solid fa-file-arrow-up text-white"></i>
                                            <i class="iconHidden hidden fa-regular fa-circle-check text-white"></i>
                                            <span class="fileSpan text-white">ファイル選択</span>
                                        </label>
                                        <div class="flexColumnCenter">
                                            <img src="{{asset($value->path_1)}}" class="w-full rounded-8 shrink-0 object-cover">
                                            <p class="text-xs">※現在の画像</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flexColumnCenter gap-2">
                                        <label class="py-2 px-4 bg-black hover:cursor-pointer">
                                            <input type="file" accept="image/jpeg,image/png"  name="path_2" class="imgInput hidden">
                                            <i class="iconDefault fa-solid fa-file-arrow-up text-white"></i>
                                            <i class="iconHidden hidden fa-regular fa-circle-check text-white"></i>
                                            <span class="fileSpan text-white">ファイル選択</span>
                                        </label>
                                        <div class="flexColumnCenter">
                                            <img src="{{asset($value->path_2)}}" class="rounded-8 shrink-0 object-cover">
                                            <p class="text-xs">※現在の画像</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="my-2"><input class="text-xs text-dashInputColor" type="text" name="school" value="{{$value["school"]}}" required></p>
                                    <p class="my-2"><input class="text-xs text-dashInputColor" type="text" name="department" value="{{$value["department"]!=null?$value["department"]:null}}" placeholder="〇〇学部"></p>
                                    <p><input class="text-xs text-dashInputColor" type="text" name="faculty" value="{{$value["faculty"]!=null?$value["faculty"]:null}}" placeholder="〇〇学科"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="my-2"><input class="text-xs text-dashInputColor" type="text" name="hire_year" value="{{$value["hire_year"]}}" required></p>
                                    <p><input class="text-xs text-dashInputColor" type="text" name="job_dpt" value="{{$value["job_dpt"]}}" required></p>
                                </td>
                                <td class="px-6 py-4 w-full"><textarea name="title" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["title"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_1" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_1"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_2" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_2"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_3" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_3"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_4" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_4"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_5" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_5"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_6" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_6"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_7" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_7"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_8" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["question_8"]}}</textarea></td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        {{--社員追加--}}
        <section class="w-[90%] flexColumn gap-8">
            <x-dash-title title="社員インタビュー追加" en="New Interview"></x-dash-title>
            <form class="Form flexColumn gap-8" method="post" action="{{route("add-interview")}}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 氏名</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="山田　太郎" required />
                    </div>
                    <div>
                        <label for="hire_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 入社年</label>
                        <input type="text" name="hire_year" id="hire_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2023年" required />
                    </div>
                    <div>
                        <label for="school" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 最終学歴</label>
                        <input type="text" name="school" id="school" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="〇〇大学" required />
                    </div>
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">学部</label>
                        <input type="text" name="department" id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="〇〇学部" />
                    </div>
                    <div>
                        <label for="faculty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">学科</label>
                        <input type="text" name="faculty" id="faculty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="〇〇学科" />
                    </div>
                    <div>
                        <label for="job_dpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 職種</label>
                        <input type="text" name="job_dpt" id="job_dpt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="開発設計部　電気設計" required />
                    </div>
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> タイトル</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <br>
                    <div>
                        <label for="question_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 入社へのきっかけ、決め手は？</label>
                        <textarea name="question_1" id="question_1" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 仕事のやりがいを感じるとき</label>
                        <textarea name="question_2" id="question_2" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 日々、意識していること</label>
                        <textarea name="question_3" id="question_3" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 今後の目標</label>
                        <textarea name="question_4" id="question_4" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 就職活動中の皆さんへ</label>
                        <textarea name="question_5" id="question_5" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> ある1日のスケジュール</label>
                        <textarea name="question_6" id="question_6" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> キャリアパス</label>
                        <textarea name="question_7" id="question_7" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_8" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 休日の過ごし方</label>
                        <textarea name="question_8" id="question_8" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="path_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> プロフィール画像①</label>
                        <input type="file" accept="image/jpeg,image/png"  name="path_1" id="path_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div>
                        <label for="path_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> プロフィール画像②</label>
                        <input type="file" accept="image/jpeg,image/png"  name="path_2" id="path_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                </div>

                <x-register_btn></x-register_btn>
            </form>
        </section>
    </div>
</x-dash-layout>

<script>
    // テーブルinput表示・非表示切り替え(eventFlagにはdiplay:node)
    let editTr = document.getElementsByClassName("editTr");
    let originalTr = document.getElementsByClassName("originalTr");
    let editBtn = document.getElementsByClassName("editBtn");
    let closeBtn = document.getElementsByClassName("closeBtn");

    for(let i = 0;i<editTr.length;i++){
        dashTrToggle(i)
    }

    // inputファイルのデザイン変更
    let imgInput = document.getElementsByClassName("imgInput");
    let fileSpan = document.getElementsByClassName("fileSpan");
    let iconHidden = document.getElementsByClassName("iconHidden");
    let iconDefault = document.getElementsByClassName("iconDefault");

    for(let i = 0;i<imgInput.length;i++){
        resetTwoInputValue(i)
        uploadTwoFile(i)
    }

    function deleteInterview(id) {

        // Ajaxリクエストを送信して削除処理を行う
        fetch('{{ route('deleteInterview') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => {
                if (response.ok) {
                    // 削除が成功したらページをリロードするなどの処理を行う
                    location.reload();
                    console.log("ok")
                } else {
                    // エラーメッセージを表示するなどの処理を行う
                    console.error('削除に失敗しました');
                }
            })
            .catch(error => {
                console.error('削除に失敗しました:', error);
            });
    }
</script>

