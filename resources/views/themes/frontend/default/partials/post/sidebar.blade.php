 <!-- sidebar -->
 <div class="sidebar">
     <!-- widget about -->
     {!! $user_theme->widget('company_info') !!}

     <!-- widget categories -->
     <div class="widget rounded">
         <div class="widget-header text-center">
             <h3 class="widget-title">Explore Topics</h3>
             <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
         </div>
         <div class="widget-content">
             <ul class="list">
                 <li><a href="#">Lifestyle</a><span>(5)</span></li>
                 <li><a href="#">Inspiration</a><span>(2)</span></li>
                 <li><a href="#">Fashion</a><span>(4)</span></li>
                 <li><a href="#">Politic</a><span>(1)</span></li>
                 <li><a href="#">Trending</a><span>(7)</span></li>
                 <li><a href="#">Culture</a><span>(3)</span></li>
             </ul>
         </div>

     </div>

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
     <div class="widget rounded">
         <div class="widget-header text-center">
             <h3 class="widget-title">Tag Clouds</h3>
             <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
         </div>
         <div class="widget-content">
             <a href="#" class="tag">#Trending</a>
             <a href="#" class="tag">#Video</a>
             <a href="#" class="tag">#Featured</a>
             <a href="#" class="tag">#Gallery</a>
             <a href="#" class="tag">#Celebrities</a>
         </div>
     </div>

 </div>
