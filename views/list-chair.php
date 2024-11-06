<style>
.tv {
    border-top: 10px solid #000;
    border-radius: 10px;
}

.seat {
    list-style-type: none;
    margin-right: 2rem;
    font-weight: bold;
    position: relative;
    /* Ensure relative positioning for absolute child elements */
}

.seat::before {
    content: '';
    display: inline-block;
    /* Allows for width and height */
    width: 20px;
    margin-bottom: 2px;
    /* Width of the square */
    height: 20px;
    /* Height of the square */
    /* Change color as needed (red in this case) */
    margin-right: 0.5rem;
    /* Space between the square and text */
    vertical-align: middle;
    border: 2px solid;
    border-radius: 5px;
    /* Aligns the square with the text */
}

.seat.couple::before {
    width: 40px;
}

.seat.vip {
    color: goldenrod;
}

.seat.single {
    color: blueviolet;
}

.seat.couple {
    color: plum;
}

.seat.choosed {
    color: blue;
}

.seat.selected {
    color: gray;
}

.list {
    cursor: default;
}

.list button {
    background: #fff;
    padding: 1px 8px;
    transition: all .2s ease;
}

.list button:hover {
    transform: scale(1.1);
    background: #7f33ff;
    border: 1px solid #7f33ff;
    color: #fff;
}
</style>

<div class="container movie-content">
    <h4 class="text-center mb-4 text-uppercase fw-bold">Chọn ghế</h4>

    <div class="type-chair">
        <ul class=" d-flex flex-row justify-content-center">
            <li class="seat vip">Ghế vip</li>
            <li class="seat single">Ghế đơn</li>
            <li class="seat couple">Ghế đôi</li>
            <li class="seat choosed">Ghế đã chọn</li>
            <li class="seat selected">Ghế đã đặt</li>
        </ul>
    </div>
    <div class="room px-5">
        <div class="d-flex justify-content-center flex-column">
            <div class="tv mx-5"></div>
            <span class="text-center text-secondary">Màn hình</span>
        </div>
        <div class="list-chair mt-5">
            <ul class="container-fluid d-flex flex-column">
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
            </ul>
        </div>
    </div>
</div>