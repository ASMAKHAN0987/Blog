const avatar = document.querySelector('.avatar');
    const avater_part_con = document.querySelector('ul.avater-part-con');
    const fa_times = document.querySelector('nav .fa-times');
    avatar.addEventListener('click', () => {
      console.log("hello");
      avater_part_con.classList.toggle('hide');
    });
    var navlinks = document.getElementById("navlinks");

    function hideMenu() {
      navlinks.style.right = "-200px";
      fa_times.style.display = "none"
    }

    function showMenu() {
      navlinks.style.right = "0";
      fa_times.style.display = "block"
    }