const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //slide images with button
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left : scrollAmount, behavior : "smooth"});
        });
        
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
    });
}
const initSlider2 = () => {
    const imageList2 = document.querySelector(".slider-wrapper2 .image-list2");
    const slideButtons2 = document.querySelectorAll(".slider-wrapper2 .slide-button2");
    const maxScrollLeft2 = imageList2.scrollWidth - imageList2.clientWidth;

    //slide images with button
    slideButtons2.forEach(button => {
        button.addEventListener("click", () => {
            console.log(button)
            const direction2 = button.id === "prev-slide2" ? -1 : 1;
            const scrollAmount2 = imageList2.clientWidth * direction2;
            imageList2.scrollBy({left : scrollAmount2, behavior : "smooth"});
        });
        
    });

    const handleSlideButtons = () => {
        slideButtons2[0].style.display = imageList2.scrollLeft <= 0 ? "none" : "block";
        slideButtons2[1].style.display = imageList2.scrollLeft >= maxScrollLeft2 ? "none" : "block";
    }

    imageList2.addEventListener("scroll", () => {
        handleSlideButtons();
    });
}
const initSlider3 = () => {
    const imageList3 = document.querySelector(".slider-wrapper3 .image-list3");
    const slideButtons3 = document.querySelectorAll(".slider-wrapper3 .slide-button3");
    const maxScrollLeft3 = imageList3.scrollWidth - imageList3.clientWidth;

    //slide images with button
    slideButtons3.forEach(button => {
        button.addEventListener("click", () => {
            console.log(button)
            const direction3 = button.id === "prev-slide3" ? -1 : 1;
            const scrollAmount3 = imageList3.clientWidth * direction3;
            imageList3.scrollBy({left : scrollAmount3, behavior : "smooth"});
        });
        
    });

    const handleSlideButtons = () => {
        slideButtons3[0].style.display = imageList3.scrollLeft <= 0 ? "none" : "block";
        slideButtons3[1].style.display = imageList3.scrollLeft >= maxScrollLeft3 ? "none" : "block";
    }

    imageList3.addEventListener("scroll", () => {
        handleSlideButtons();
    });
}

window.addEventListener("load", initSlider);
window.addEventListener("load", initSlider2);
window.addEventListener("load", initSlider3);