 <section class="call-action overlay section">
     <div class="container">
         <div class="row ">
             <div class="col-lg-8 offset-lg-2 col-12">
                 <div class="inner">
                     <div class="content">
                         <h2 class="wow fadeInUp" data-wow-delay=".4s"
                             style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                             @lang('messages.sell_question')
                         </h2>
                         <p class="wow fadeInUp" data-wow-delay=".6s"
                             style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                             @lang('messages.post_ad_description')
                         </p>
                         <div class="button wow fadeInUp" data-wow-delay=".8s"
                             style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                             <a href="{{ route('ads.create') }}" class="btn">@lang('messages.post_ad_btn')</a>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </section>
