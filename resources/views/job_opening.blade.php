<x-dash-layout>
    <div class="flexColumn items-center gap-16 py-10">
        {{--現在の一覧表示--}}
        <section class="w-[90%] flexColumn gap-8 sm:rounded-lg">
            <x-dash-title title="募集職種・募集要項一覧" en="Job Description List"></x-dash-title>

            <div class="overflow-y-auto overflow-x-auto h-600">
                <table class="whitespace-nowrap shadow-md w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3 _sticky_ab">
                            編集
                        </th>
                        <th scope="col" class="px-6 py-3 _sticky_ab2">
                            削除
                        </th>
                        <th scope="col" class="px-6 py-3 _sticky_b">
                            募集部門
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            募集対象
                        </th>
                        <th scope="col" class="px-16 py-3 _sticky_b">
                            募集人数
                        </th>
                        <th scope="col" class="px-24 py-3 _sticky_b">
                            希望する人物像
                        </th>
                        @for($i=1;$i<=$tmp_column_count;$i++)
                            <th scope="col" class="px-16 py-3 _sticky_b">
                                募集職種{{$i}} タイトル
                            </th>
                            <th scope="col" class="px-16 py-3 _sticky_b">
                                募集職種{{$i}} コンテンツ
                            </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($job_openings as $key=>$value)
                        {{--最初表示されるtr--}}
                        <tr class="h-64 originalTr bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 w-42 _sticky_a text-gray-700 uppercase bg-gray-50">
                                <div class="flexCenter">
                                    <a class="editBtn font-medium text-blue-600 dark:text-blue-500 hover:underline">編集</a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteJobOpening({{ $value['id'] }})">削除</button>
                                </div>
                            </td>
                            {{--<livewire:job-opening-livewire :id="$value->id" :job_opening_id="$value->job_opening[0]['job_opening_id']"></livewire:job-opening-livewire>--}}
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    {{$value["title"]}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="flexCenter">
                                    {{$value["job_target"]!=null?$value["job_target"]:"-"}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flexCenter">
                                    {{$value["recruit_number"]!=null?$value["recruit_number"]:"-"}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="flexCenter">
                                    {{$value["ideal_emp"]!=null?$value["ideal_emp"]:"-"}}
                                </div>
                            </td>
                                <?php  $count=0;  ?>

                            @foreach($value->job_opening as $idx=>$val)
                                    <?php $count++; ?>
                                @if($val["job_title"]!=null)
                                    <td class="px-6 py-4 w-150">
                                        <div class="flexCenter">
                                            {{$val["job_title"]}}
                                        </div>
                                    </td>
                                @else
                                    <td class="px-6 py-4 w-150">
                                        <div class="flexCenter">-</div>
                                    </td>
                                @endif

                                @if($val["job_content"]!=null)
                                    <td class="px-6 py-4 whitespace-normal">
                                        <div class="flexCenter">
                                            {{$val["job_content"]}}
                                        </div>
                                    </td>
                                @else
                                    <td class="px-6 py-4 w-150">
                                        <div class="flexCenter">-</div>
                                    </td>
                                @endif
                            @endforeach

                            {{--空欄埋めるための空っぽのtd作成--}}
                            @for($i=$count;$i<$tmp_column_count;$i++)
                                <td class="px-6 py-4 w-150"><div class="flexCenter">-</div></td>
                                <td class="px-6 py-4 w-150"><div class="flexCenter">-</div></td>
                            @endfor
                        </tr>

                        {{--hidden (編集用tr)--}}
                        <tr class="h-64 editTr text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <form method="post" action="{{route('update-job_opening',$value)}}" enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <input type="hidden" value="{{$value->job_opening[0]["job_opening_id"]}}" name="job_opening_id">
                                <input type="hidden" value="{{$value["id"]}}" name="id">
                                <td class="px-2 py-4 _sticky_a">
                                    <x-dashboard_btn></x-dashboard_btn>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flexCenter">
                                        <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteJobOpening({{ $value['id'] }})">削除</button>
                                    </div>
                                </td>
                                {{--<livewire:job-opening-livewire :id="$value->id"></livewire:job-opening-livewire>--}}
                                <td class="px-2 py-4 w-150"><input type="text" name="title" value="{{$value["title"]}}" class="text-xs text-dashInputColor" required></td>
                                <td class="px-2 py-4 w-100"><input type="text" name="job_target" value="{{$value["job_target"]!=null?$value["job_target"]:null}}" class="text-xs text-dashInputColor"></td>
                                <td class="px-2 py-4 w-100"><input type="text" name="recruit_number" value="{{$value["recruit_number"]!=null?$value["recruit_number"]:null}}" class="text-xs text-dashInputColor"></td>
                                <td class="px-2 py-4 w-100"><textarea name="ideal_emp" class="w-full h-200 text-xs text-dashInputColor">{{$value["ideal_emp"]!=null?$value["ideal_emp"]:null}}</textarea></td>
                                <?php  $count=0;  ?>
                                @foreach($value->job_opening as $idx=>$val)
                                    <?php $count++; ?>
                                    @if($val["job_title"]!=null)
                                        <td class="px-6 py-4 w-150"><input type="text" name="info_title{{$count}}" value="{{$val["job_title"]}}" class="text-xs text-dashInputColor"></td>
                                    @else
                                        <td class="px-6 py-4 w-150"><input type="text" name="info_title{{$count}}" value="{{null}}" class="text-xs text-dashInputColor"></td>
                                    @endif

                                    @if($val["job_content"]!=null)
                                        <td class="px-6 py-4 w-150">
                                            <textarea name="info_content{{$count}}" class="w-full h-200 text-xs text-dashInputColor">{{$val["job_content"]}}</textarea>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 w-150">
                                            <textarea name="info_content{{$count}}" class="w-full h-200 text-xs text-dashInputColor"></textarea>
                                        </td>
                                    @endif
                                @endforeach

                                @for($i=$count;$i<$tmp_column_count;$i++)
                                    <td class="px-6 py-4 w-150"><input type="text" name="info_title{{$i+1}}"  class="text-xs text-dashInputColor"></td>
                                    <td class="px-6 py-4 w-150">
                                        <textarea name="info_content{{$i+1}}" class="w-full h-200 text-xs text-dashInputColor"></textarea>
                                    </td>
                                @endfor
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        {{--Add product--}}
        <section class="w-[90%] flexColumn gap-8">
            <x-dash-title title="募集職種・募集要項追加" en="New Job Description"></x-dash-title>

            <form class="Form flexColumn gap-8" method="post" action="{{route("add-job_opening")}}" enctype="multipart/form-data">
                @csrf
                <div class="add_job_form grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 募集部門</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="営業部門" required />
                    </div>
                    <div>
                        <label for="job_target" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">募集対象</label>
                        <input type="text" name="job_target" id="job_target" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="理系大学院生、理系学部生" />
                    </div>
                    <div>
                        <label for="recruit_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">募集人数</label>
                        <input type="text" name="recruit_number" id="recruit_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1~5名" />
                    </div>
                    <div>
                        <label for="ideal_emp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">希望する人物像</label>
                        <input type="text" name="ideal_emp" id="ideal_emp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="人と話をするのが好きな方" />
                    </div>
                    <div>
                        <label for="info_title1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">募集職種1 タイトル</label>
                        <input type="text" name="info_title1" id="info_title1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="機械設計" />
                    </div>
                    <div>
                        <label for="info_content1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="bg-red-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-8">必須</span> 募集職種1 内容</label>
                        <input type="text" name="info_content1" id="info_content1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="顧客との打ち合わせ／工作機械・プラント等" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="add_job text-black bg-white hover:bg-black hover:text-white border-2 border-solid border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-3 text-center"><i class="fa-solid fa-user-plus text-base"></i> 募集職種の追加</button>
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

    // 募集職種追加

    let add_job_btn = document.getElementsByClassName("add_job")[0];
    let count = 1;

    add_job_btn.addEventListener("click",function (){
        count++;
        let new_input_title = document.createElement("input");
        let new_label_title = document.createElement("label");
        let new_div_title = document.createElement("div");

        new_label_title.innerText = "募集職種"+count +" タイトル";
        new_label_title.classList.add("block","mb-2","text-sm","font-medium","text-gray-900","dark:text-white")
        new_input_title.classList.add("bg-gray-50","border","border-gray-300","text-gray-900","text-sm","rounded-lg","focus:ring-blue-500","focus:border-blue-500","block","w-full","p-2.5","dark:bg-gray-700","dark:border-gray-600","dark:placeholder-gray-400","dark:text-white","dark:focus:ring-blue-500","dark:focus:border-blue-500")
        new_input_title.setAttribute('name', 'info_title'+count);

        new_div_title.appendChild(new_label_title);
        new_div_title.appendChild(new_input_title);

        let new_input_content = document.createElement("input");
        let new_label_content = document.createElement("label");
        let new_span = document.createElement("span");
        let new_div_content = document.createElement("div");

        new_label_content.innerText = "募集職種"+count +" 内容";
        new_span.innerText = "必須";
        new_label_content.classList.add("block","mb-2","text-sm","font-medium","text-gray-900","dark:text-white")
        new_span.classList.add("bg-red-500","text-white","text-sm","font-medium","me-2","px-2.5","py-0.5","rounded-8");
        new_input_content.classList.add("bg-gray-50","border","border-gray-300","text-gray-900","text-sm","rounded-lg","focus:ring-blue-500","focus:border-blue-500","block","w-full","p-2.5","dark:bg-gray-700","dark:border-gray-600","dark:placeholder-gray-400","dark:text-white","dark:focus:ring-blue-500","dark:focus:border-blue-500")
        new_input_content.setAttribute('name', ' info_content'+count);
        new_input_content.setAttribute('required', '');

        new_label_content.prepend(new_span);
        new_div_content.appendChild(new_label_content);
        new_div_content.appendChild(new_input_content);

        let add_job_form = document.getElementsByClassName("add_job_form")[0];
        add_job_form.appendChild(new_div_title);
        add_job_form.appendChild(new_div_content);
    })

    function deleteJobOpening(id) {

        // Ajaxリクエストを送信して削除処理を行う
        fetch('{{ route('deleteJobOpening') }}', {
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
