// intersection observer for animation, for div that has hidden class
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        // console.log(entry);
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
        } else {
            // entry.target.classList.remove("show");
            //removed for avoiding continous animation
        }
    });
});

const hiddenElements = document.querySelectorAll(".hidden");
hiddenElements.forEach((el) => observer.observe(el));
