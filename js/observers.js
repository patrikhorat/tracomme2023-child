// Menu Logo Resize
const header = document.querySelector(".navbar-brand");
const sectionOne = document.querySelector("h1");

const sectionOneOptions = {
  rootMargin: "-200px 0px 0px 0px"
};

const sectionOneObserver = new IntersectionObserver(function(
  entries,
  sectionOneObserver
) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      header.classList.add("shrinklogo");
    } else {
      header.classList.remove("shrinklogo");
    }
  });
},
sectionOneOptions);

sectionOneObserver.observe(sectionOne);
