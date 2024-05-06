{{--背景ぼかし黒--}}
<div class="flexCenter fixed left-0 top-0 z-100 min-h-screen w-full bg-black/85 px-4">

    {{--Modal親タグ (背景色/白色)--}}
    <div class="relative overscroll-y-contain overflow-y-scroll bg-white w-full h-[90vh] md:h-[70vh] md:mb-64 lg:mb-8 lg:h-[90vh] md:w-85% lg:w-8/12 max-w-screen-lg rounded-[20px] md:px-8 lg:my-12 text-center">
        <!-- Modal content -->
        <div class="overflow-scroll flexColumnCenter p-6">

                {{--Modal header--}}
                <div class="ml-0 fixed top-53 right-20 lg:right-260 2xl:right-[24%] z-100">
                    <button type="button" class="ml-auto closeModalBtn"><i class="fa-solid fa-xmark text-4xl font-bold"></i></button>
                </div>

                {{--Modal body--}}
                <div class="w-full pt-4">

                    {{--トップ画像--}}
                    <div class="w-full relative">
                        <img src="{{asset($modalData["path_1"])}}" class="md:h-550 w-full object-cover">

                        <h3 class="bg-indigo-50 opacity-75 shadow-[0px 0px 8px rgba(255, 255, 255, 0.50)] text-md absolute bottom-0 w-full px-4 py-2 text-start font-black !leading-relaxed text-textBlack md:text-3xl">
                            {{$modalData["title"]}}
                        </h3>
                    </div>

                    {{--学校詳細--}}
                    <div class="flexColumnCenter md:flex-row gap-8 py-6">
                        <div class="flex items-center">
                            <p class="text-white bg-baseColor px-3 py-1">{{$modalData["job_dpt"]}}</p>
                        </div>
                        <aside class="flex flex-col">
                            <div class="flex gap-2">
                                <h4 class="text-baseColor font-bold text-xl">{{$modalData["name"]}}</h4>
                                <p class="text-sm md:text-base">{{$modalData["hire_year"]}}入社</p>
                            </div>
                            <p class="text-sm md:text-base">
                                {{$modalData["school"]}} {{$modalData["department"]}} {{$modalData["faculty"]}}卒業
                            </p>
                        </aside>
                    </div>

                    {{--各質問--}}
                    <div class="flexColumn gap-4 text-sm md:text-base">
                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                入社へのきっかけ、決め手は？
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_1"]}}</p>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                仕事のやりがいを感じるとき
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_2"]}}</p>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                日々、意識していること
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_3"]}}</p>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                今後の目標
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_4"]}}</p>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                就職活動中の皆さんへ
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_5"]}}</p>
                            <img src="{{asset($modalData["path_2"])}}" class="pt-4 w-full object-cover">
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                ある1日のスケジュール
                            </h4>
                            <div class="mt-4">
                                <p class="text-md mt-4 text-left leading-relaxed whitespace-pre-wrap">{{$modalData["question_6"]}}</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                キャリアパス
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed whitespace-pre-wrap">{{$modalData["question_7"]}}</p>
                        </div>

                        <div>
                            <h4 class="border-baseColor text-baseColor border-l-4 bg-modalTitleBg py-2 pl-4 text-left font-bold">
                                休日の過ごし方
                            </h4>
                            <p class="text-md mt-4 text-left leading-relaxed">{{$modalData["question_8"]}}</p>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div  class="flex items-center mt-8 p-4 md:p-5 rounded-b dark:border-gray-600">
                    <button type="button" class="closeModalBtn2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">閉じる</button>
                </div>
        </div>
    </div>
    <div class="nonScroll"></div>
</div>



