 <!-- sidebar -->
 <div class="sidebar">
     <!-- widget about -->
     {!! $user_theme->widget('company_info') !!}

     <!-- widget categories -->
     {!! $user_theme->widget('category') !!}
     <!-- widget newsletter -->
     {!! $user_theme->widget('newsletter') !!}

     <!-- widget post carousel -->
     {!! $user_theme->widget('latest-post') !!}

     <!-- widget advertisement -->
     <div class="widget no-container rounded text-md-center">
         <span class="ads-title">- Sponsored Ad -</span>
         <a href="#" class="widget-ads">
             <img src="images/ads/ad-360.png" alt="Advertisement" />
         </a>
     </div>

     <!-- widget tags -->

 </div>
