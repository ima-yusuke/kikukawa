<x-dash-layout>
    <div class="flexColumn items-center gap-16 py-10">
        {{--現在の一覧表示--}}
        <section class="w-[90%] flexColumn gap-8 sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">【 社員インタビュー　一覧 】</h2>
            <div class="overflow-scroll">
                <table class="whitespace-nowrap w-[95%] shadow-md text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center text-sm">
                        <th scope="col" class="px-2 py-3">
                            氏名
                        </th>
                        <th scope="col" class="px-2 py-3">
                            プロフィール画像①
                        </th>
                        <th scope="col" class="px-2 py-3">
                            プロフィール画像②
                        </th>
                        <th scope="col" class="px-2 py-3">
                            最終学歴
                        </th>
                        <th scope="col" class="px-2 py-3">
                            入社年/職種
                        </th>
                        <th scope="col" class="px-16 py-3">
                            タイトル
                        </th>
                        <th scope="col" class="px-16 py-3">
                            入社のきっかけ
                        </th>
                        <th scope="col" class="px-16 py-3">
                            仕事のやりがい
                        </th>
                        <th scope="col" class="px-16 py-3">
                            日々、意識していること
                        </th>
                        <th scope="col" class="px-16 py-3">
                            今後の目標
                        </th>
                        <th scope="col" class="px-16 py-3">
                            就職活動中の皆さんへ
                        </th>
                        <th scope="col" class="px-16 py-3">
                            1日のスケジュール
                        </th>
                        <th scope="col" class="px-16 py-3">
                            キャリアパス
                        </th>
                        <th scope="col" class="px-16 py-3">
                            休日の過ごし方
                        </th>
                        <th scope="col" class="px-2 py-3">
                            編集
                        </th>
                        <th scope="col" class="px-2 py-3">
                            削除
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($interviews as $key=>$value)
                        {{-- 最初表示されるtr--}}
                        <tr class="text-xs originalTr bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="text-center px-6 py-4 w-[5%] ">{{$value["name"]}} </td>
                            <td class="text-center px-2 py-4 w-100">
                                <img src="{{asset($value->path_1)}}" class="rounded-8 shrink-0 object-cover">
                            </td>
                            <td class="text-center px-2 py-4 w-100">
                                <img src="{{asset($value->path_2)}}" class="rounded-8 shrink-0 object-cover">
                            </td>
                            <td class="text-center px-2 py-4 w-150">
                                <p>{{$value["school"]}}</p>
                                <p>{{$value["department"]!=null?$value["department"]:null}}</p>
                                <p>{{$value["faculty"]!=null?$value["faculty"]:null}}</p>
                            </td>
                            <td class="text-center px-6 py-4 w-150">
                                <p>{{$value["hire_year"]}}入社</p>
                                <p>{{$value["job_dpt"]}}</p>
                            </td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["title"]}} </td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_1"]}}</td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_2"]}}</td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_3"]}}</td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_4"]}}</td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_5"]}}</td>
                            <td class="px-2 py-4 whitespace-pre">{{$value["question_6"]}}</td>
                            <td class="px-2 py-4 whitespace-pre">{{$value["question_7"]}}</td>
                            <td class="px-2 py-4 whitespace-normal">{{$value["question_8"]}}</td>
                            <td class="px-6 py-4">
                                <a href="#" class="editBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                            <livewire:interview-livewire :id="$value->id"></livewire:interview-livewire>
                        </tr>

                        {{--hidden (編集用tr)--}}
                        <tr class="editTr text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <form method="post" action="{{route('update-interview',$value)}}" enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <td class="px-6 py-4"><input class="text-xs" type="text" name="name" value="{{$value["name"]}}"></td>
                                <td class="px-6 py-4"><input class="text-xs" type="file" name="path_1"></td>
                                <td class="px-6 py-4"><input class="text-xs" type="file" name="path_2"></td>
                                <td class="px-6 py-4">
                                    <p class="my-2"><input class="text-xs" type="text" name="school" value="{{$value["school"]}}"></p>
                                    <p class="my-2"><input class="text-xs" type="text" name="department" value="{{$value["department"]!=null?$value["department"]:null}}" placeholder="〇〇学部"></p>
                                    <p><input class="text-xs" type="text" name="faculty" value="{{$value["faculty"]!=null?$value["faculty"]:null}}" placeholder="〇〇学科"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="my-2"><input class="text-xs" type="text" name="hire_year" value="{{$value["hire_year"]}}"></p>
                                    <p><input class="text-xs" type="text" name="job_dpt" value="{{$value["job_dpt"]}}"></p>
                                </td>
                                <td class="px-6 py-4 w-full"><textarea name="title" class="w-full h-200 text-xs">{{$value["title"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_1" class="w-full h-200 text-xs">{{$value["question_1"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_2" class="w-full h-200 text-xs">{{$value["question_2"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_3" class="w-full h-200 text-xs">{{$value["question_3"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_4" class="w-full h-200 text-xs">{{$value["question_4"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_5" class="w-full h-200 text-xs">{{$value["question_5"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_6" class="w-full h-200 text-xs">{{$value["question_6"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_7" class="w-full h-200 text-xs">{{$value["question_7"]}}</textarea></td>
                                <td class="px-6 py-4 w-full"><textarea name="question_8" class="w-full h-200 text-xs">{{$value["question_8"]}}</textarea></td>
                                <td class="px-6 py-4">
                                    <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">save</button>
                                    <a href="#" class="closeBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">✗</a>
                                </td>
                            </form>
                            <livewire:interview-livewire :id="$value->id"></livewire:interview-livewire>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        {{--社員追加--}}
        <section class="w-[90%] flexColumn gap-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">【 社員の追加 】</h2>
            <form class="Form flexColumn gap-8" method="post" action="{{route("add-interview")}}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊氏名</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="山田　太郎" required />
                    </div>
                    <div>
                        <label for="hire_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊入社年</label>
                        <input type="text" name="hire_year" id="hire_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2023年" required />
                    </div>
                    <div>
                        <label for="school" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊最終学歴</label>
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
                        <label for="job_dpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊職種</label>
                        <input type="text" name="job_dpt" id="job_dpt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="開発設計部　電気設計" required />
                    </div>
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊タイトル</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <br>
                    <div>
                        <label for="question_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊入社へのきっかけ、決め手は？</label>
                        <textarea name="question_1" id="question_1" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊仕事のやりがいを感じるとき</label>
                        <textarea name="question_2" id="question_2" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊日々、意識していること</label>
                        <textarea name="question_3" id="question_3" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊今後の目標</label>
                        <textarea name="question_4" id="question_4" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="question_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊就職活動中の皆さんへ</label>
                        <textarea name="question_5" id="question_5" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊ある1日のスケジュール</label>
                        <textarea name="question_6" id="question_6" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊キャリアパス</label>
                        <textarea name="question_7" id="question_7" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="question_8" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊休日の過ごし方</label>
                        <textarea name="question_8" id="question_8" class="h-150 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ></textarea>
                    </div>
                    <div>
                        <label for="path_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊プロフィール画像①</label>
                        <input type="file" name="path_1" id="path_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div>
                        <label for="path_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">＊プロフィール画像②</label>
                        <input type="file" name="path_2" id="path_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-3 text-center">登録</button>
                </div>
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
        editTr[i].classList.add("eventFlag");

        editBtn[i].addEventListener("click",function (){
            editTr[i].classList.remove("eventFlag");
            originalTr[i].classList.add("eventFlag");
        })

        closeBtn[i].addEventListener("click",function (){
            originalTr[i].classList.remove("eventFlag");
            editTr[i].classList.add("eventFlag");
        })
    }

</script>
