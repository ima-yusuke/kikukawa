<x-dash-layout>
    <div class="flexColumn items-center gap-16 py-10">
        {{--現在の一覧表示--}}
        <section class="w-[90%] flexColumn gap-8 sm:rounded-lg">
            <x-dash-title title="メッセージ一覧" en="Message List"></x-dash-title>

            <div class="overflow-y-auto overflow-x-auto h-600">
                <table class="shadow-md w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        編集
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        削除
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        役職
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        氏名
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        プロフィール画像
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        タイトル
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        メッセージ
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $key=>$value)
                    {{--最初表示されるtr--}}
                    <tr class="originalTr bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 w-100">
                            <div class="flexCenter">
                                <a class="editBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">編集</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flexCenter">
                                <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteMessage({{ $value['id'] }})">削除</button>
                            </div>
                        </td>
                        {{--<livewire:message-livewire :id="$value->id"></livewire:message-livewire>--}}
                        <td class="px-6 py-4 w-130 text-center">{{$value["role"]!=null?$value["role"]:"-"}}</td>
                        <td class="px-6 py-4 w-130 text-center">{{$value["name"]}} </td>
                        <td class="px-6 py-4">
                            <div class="flexCenter">
                                <img src="{{asset($value->path)}}" class="w-[50%] rounded-8 shrink-0 object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4 w-180">{{$value["title"]}} </td>
                        <td class="px-6 py-4 w-350">{{$value["msg"]}} </td>
                    </tr>

                    {{--hidden (編集用tr)--}}
                    <tr class="editTr text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <form method="post" action="{{route('update-message',$value)}}" enctype="multipart/form-data">
                            @csrf
                            @method("patch")
                            <td class="px-2 py-4">
                                <x-dashboard_btn></x-dashboard_btn>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteMessage({{ $value['id'] }})">削除</button>
                                </div>
                            </td>
                            {{--<livewire:message-livewire :id="$value->id"></livewire:message-livewire>--}}

                            <td class="px-2 py-4"><input type="text" name="role" value="{{$value["role"]!=null?$value["role"]:null}}" class="text-xs text-dashInputColor"></td>
                            <td class="px-2 py-4"><input type="text" name="name" value="{{$value["name"]}}" class="text-xs text-dashInputColor" required> </td>
                            <td class="px-6 py-4">
                                <div class="flexColumnCenter gap-2">
                                    <label class="py-2 px-4 bg-black hover:cursor-pointer">
                                        <input type="file" accept="image/jpeg,image/png"  name="image" class="imgInput hidden">
                                        <i class="iconDefault fa-solid fa-file-arrow-up text-white"></i>
                                        <i class="iconHidden hidden fa-regular fa-circle-check text-white"></i>
                                        <span class="fileSpan text-white">ファイル選択</span>
                                    </label>
                                    <div class="flexColumnCenter">
                                        <img src="{{asset($value->path)}}" class="w-4/12 rounded-8 shrink-0 object-cover">
                                        <p class="text-xs">※現在の画像</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-4"><textarea  name="title" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["title"]}}</textarea></td>
                            <td class="px-2 py-8"><textarea  name="msg" class="w-full h-200 text-xs text-dashInputColor" required>{{$value["msg"]}}</textarea></td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </section>

        {{--Add product--}}
        <section class="w-[90%] flexColumn gap-8">
            <x-dash-title title="メッセージ追加" en="New Message"></x-dash-title>

            <form class="Form flexColumn gap-8" method="post" action="{{route("add-message")}}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 氏名</label>
                        <input type="text" name="name" id="p_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="山田　太郎" required />
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">役職</label>
                        <input type="text" name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="代表取締役" />
                    </div>
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> タイトル</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="タイトル" required />
                    </div>
                    <div>
                        <label for="msg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> メッセージ</label>
                        <textarea name="msg" id="msg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="メッセージ" required ></textarea>
                    </div>
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> プロフィール画像</label>
                        <input type="file" name="image" accept="image/jpeg,image/png"  id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
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

    let imgInput = document.getElementsByClassName("imgInput");
    let fileSpan = document.getElementsByClassName("fileSpan");
    let iconHidden = document.getElementsByClassName("iconHidden");
    let iconDefault = document.getElementsByClassName("iconDefault");

    for(let i = 0;i<imgInput.length;i++){
        resetInputValue(i);
        uploadFile(i)
    }

    function deleteMessage(id) {

        // Ajaxリクエストを送信して削除処理を行う
        fetch('{{ route('deleteMessage') }}', {
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
