<x-dash-layout>
    <div class="flexColumn items-center gap-16 py-10">
        {{--現在の一覧表示--}}
        <section class="w-[90%] flexColumn gap-8 sm:rounded-lg">
            <x-dash-title title="質問一覧" en="Question List"></x-dash-title>

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
                        質問
                    </th>
                    <th scope="col" class="px-6 py-3 _sticky_b">
                        回答
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $key=>$value)
                    {{--最初表示されるtr--}}
                    <tr class="h-120 originalTr bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <div class="flexCenter">
                                <a class="editBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">編集</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flexCenter">
                                <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteQuestion({{ $value['id'] }})">削除</button>
                            </div>
                        </td>
                        {{--<livewire:question-livewire :id="$value->id"></livewire:question-livewire>--}}
                        <td class="px-6 py-4 w-[30%]">
                            <div class="flexCenter">{{$value["question"]}} </div>
                        </td>
                        <td class="px-6 py-4 w-[50%]">
                            <div class="flexCenter">{{$value["answer"]}}</div>
                        </td>
                    </tr>

                    {{--hidden (編集用tr)--}}
                    <tr class="h-120 editTr text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <form method="post" action="{{route('update-question',$value)}}" enctype="multipart/form-data">
                            @csrf
                            @method("patch")
                            <td class="px-2 py-4">
                                <x-dashboard_btn></x-dashboard_btn>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteQuestion({{ $value['id'] }})">削除</button>
                                </div>
                            </td>
                            {{--<livewire:question-livewire :id="$value->id"></livewire:question-livewire>--}}

                            <td class="px-2 py-4 w-[30%]"><input type="text" name="question" value="{{$value["question"]}}" class="w-full text-xs text-dashInputColor" required> </td>
                            <td class="px-2 py-4 w-[50%]"><textarea name="answer" class="w-[90%] h-100 text-xs text-dashInputColor" required>{{$value["answer"]}}</textarea></td>

                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </section>

        {{--Add product--}}
        <section class="w-[90%] flexColumn gap-8">
            <x-dash-title title="質問追加" en="New Question"></x-dash-title>

            <form class="Form flexColumn gap-8" method="post" action="{{route("add-question")}}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 質問</label>
                        <input type="text" name="question" id="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="質問" required />
                    </div>
                    <div>
                        <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 回答</label>
                        <textarea name="answer" id="answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="回答" required ></textarea>
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

    function deleteQuestion(id) {

        // Ajaxリクエストを送信して削除処理を行う
        fetch('{{ route('deleteQuestion') }}', {
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
