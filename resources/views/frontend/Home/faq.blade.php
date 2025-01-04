 <section class="faq section">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="section-title">
                     <h2 class="wow fadeInUp" data-wow-delay=".4s"
                         style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                         FAQ's </h2>
                     {{-- <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                        Discover the Power of Trending Ads – Stay Ahead of the Curve with the Latest, Most Engaging Ads that Capture Attention and Drive Results!                    </p> --}}
                 </div>

             </div>
         </div>
         <div class="accordion" id="accordionExample">
             @for ($i = 1; $i <= 13; $i++)
                 <div class="accordion-item">
                     <h2 class="accordion-header" id="heading{{ $i }}">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                             data-bs-target="#collapse{{ $i }}" aria-expanded="false"
                             aria-controls="collapse{{ $i }}">
                             <span>@lang('messages.faq_question_' . $i)</span><i class="lni lni-plus"></i>
                         </button>
                     </h2>
                     <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                         <div class="accordion-body">
                             <p>@lang('messages.faq_answer_' . $i)</p>
                         </div>
                     </div>
                 </div>
             @endfor
         </div>
     </div>
 </section>
