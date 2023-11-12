@php /** @var \App\Models\Post $post */   @endphp

{!! $user_theme->partials('post-author') !!}
{!!  $user_theme->partials('post.recent-post',['post'=> $post]) !!}
<aside class="widget widget_social">
    <h3 class="widget-title">Social share</h3>
    <div class="social-icon-wrap">
        <div class="social-icon social-facebook">
            <a href="https://www.facebook.com/">
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
            </a>
        </div>
        <div class="social-icon social-pinterest">
            <a href="https://www.pinterest.com/">
                <i class="fab fa-pinterest"></i>
                <span>Pinterest</span>
            </a>
        </div>
        <div class="social-icon social-whatsapp">
            <a href="https://www.whatsapp.com/">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp</span>
            </a>
        </div>
        <div class="social-icon social-linkedin">
            <a href="https://www.linkedin.com/">
                <i class="fab fa-linkedin"></i>
                <span>Linkedin</span>
            </a>
        </div>
        <div class="social-icon social-twitter">
            <a href="https://www.twitter.com/">
                <i class="fab fa-twitter"></i>
                <span>Twitter</span>
            </a>
        </div>
        <div class="social-icon social-google">
            <a href="https://www.google.com/">
                <i class="fab fa-google-plus-g"></i>
                <span>Google</span>
            </a>
        </div>
    </div>
</aside>
