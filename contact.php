<?php include './include/header.php'; ?>
<body>
    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center " data-wow-delay="0.1s">
                <h1 class="font-dancing-script text-primary">Contact</h1>
                <h1 class="mb-5">Drop a Message</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                      <div class="" data-wow-delay="0.3s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="Phone" placeholder="Your Phone">
                                        <label for="name">Your Phone</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message"
                                            style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-prime w-100 py-3 ms-0" type="submit">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
  <?php include './include/footer.php'; ?>
</body>

</html>