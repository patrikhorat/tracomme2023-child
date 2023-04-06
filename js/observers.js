// Menu Logo Resize
const logolocator = document.querySelector(".navbar-brand");
const ShrinkMenu = document.querySelector(".shrinkstart");

const ShrinkMenuOptions = {
  rootMargin: "-110px 0px 0px 0px"
};

const ShrinkMenuObserver = new IntersectionObserver(function(
  entries,
  ShrinkMenuObserver
) {
  
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      logolocator.classList.add("shrinklogo");
    } else {
      logolocator.classList.remove("shrinklogo");
    }
  });
},
ShrinkMenuOptions);
ShrinkMenuObserver.observe(ShrinkMenu);



