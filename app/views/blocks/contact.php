<!-- Map Begin -->
<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6696584619303!2d106.67968337444285!3d10.759922359499164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b7c3ed289%3A0xa06651894598e488!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBTw6BpIEfDsm4!5e0!3m2!1svi!2s!4v1681718127387!5m2!1svi!2s"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Viet Nam</h4>
                            <p><?php echo $address["opt_value"] ?><br /><?php echo $hotline["opt_value"] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="#">
                        <div class="row">
                            <div class="alert alert-danger btn-block alert-contact hidden">
                            </div>
                            <div class="col-lg-12">
                                <input spellcheck="false" class="name-contact" type="text" placeholder="Name"
                                    style="margin: 0; color: black;">
                                <span class="error error-name-contact"></span>
                            </div>
                            <div class="col-lg-12">
                                <input style="margin: 0; margin-top: 30px; color: black;" spellcheck="false"
                                    class="email-contact" type="text" placeholder="Email">
                                <span class="error error-email-contact"></span>
                            </div>
                            <div class="col-lg-12">
                                <textarea spellcheck="false" style="margin: 0;color: black; margin-top: 30px;"
                                    class="message" placeholder="Message"></textarea>
                                <span class="error error-message"></span>
                            </div>
                        </div>
                        <button type="submit" class="site-btn btn-block mt-3" onclick="sendMessage(event)">Send
                            Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Footer Section Begin -->

<!-- Footer Section End -->