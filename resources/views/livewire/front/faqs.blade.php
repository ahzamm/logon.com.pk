<section class="faq-section">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div class="faq-content">
                    <div class="sec-title"><h2>How To Connect with Logon</h2></div>
                    <ul class="accordion-box">
                        @foreach ($faqs as  $key =>$item)
                        <li class="accordion block ">
                            <div class="acc-btn {{$key == 0?'active':''}}">
                                <div class="icon-outer"><i class="fas fa-plus"></i></div>
                                <h4>{{$item->question}}</h4>
                            </div>
                            <div class="acc-content {{$key == 0?'current':''}}">
                                <div class="content">
                                <div class="text">{{$item->answer}}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
