<?php

    include('includes/header.php');
    $title = "FAQs - bwajes+";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

<div class="wrapper form">
        <div class="content form">
            <div style="margin-top: 30px;">
                <div class="card-body">
                    <div class="accordion">
                      <div class="accordion-item">
                        <div class="accordion-item-header">
                          Terms of Service
                        </div>
                        <div class="accordion-item-body">
                          <div class="accordion-item-body-content">
                            Web Development broadly refers to the tasks associated with developing functional websites and applications for the Internet. The web development process includes web design, web content development, client-side/server-side scripting and network security configuration, among other tasks.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div class="accordion-item-header">
                          Data Policy
                        </div>
                        <div class="accordion-item-body">
                          <div class="accordion-item-body-content">
                            HTML, aka HyperText Markup Language, is the dominant markup language for creating websites and anything that can be viewed in a web browser.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div class="accordion-item-header">
                          Content Policy
                        </div>
                        <div class="accordion-item-body">
                          <div class="accordion-item-body-content">
                            HTML, aka HyperText Markup Language, is the dominant markup language for creating websites and anything that can be viewed in a web browser.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div class="accordion-item-header">
                          Cookies Policy
                        </div>
                        <div class="accordion-item-body">
                          <div class="accordion-item-body-content">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente, dolorum.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div class="accordion-item-header">
                          Community Guidelines
                        </div>
                        <div class="accordion-item-body">
                          <div class="accordion-item-body-content">
                            HTTP, aka HyperText Transfer Protocol, is the underlying protocol used by the World Wide Web and this protocol defines how messages are formatted and transmitted, and what actions Web servers and browsers should take in response to various commands.
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

        const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

        accordionItemHeaders.forEach(accordionItemHeader => {
          accordionItemHeader.addEventListener("click", event => {
            
            // Uncomment in case you only want to allow for the display of only one collapsed item at a time!
            
            const currentlyActiveAccordionItemHeader = document.querySelector(".accordion-item-header.active");
            if(currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader!==accordionItemHeader) {
              currentlyActiveAccordionItemHeader.classList.toggle("active");
              currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
            }
    
            accordionItemHeader.classList.toggle("active");
            const accordionItemBody = accordionItemHeader.nextElementSibling;
            if(accordionItemHeader.classList.contains("active")) {
              accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
            }
            else {
              accordionItemBody.style.maxHeight = 0;
            }
            
          });
        });
    });
    </script>



<?php

    include('includes/footer.php');

?>