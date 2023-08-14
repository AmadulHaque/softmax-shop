import { useState } from 'react';
import ImgsViewer from 'react-images-viewer';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';

import './styles.css';


const AwardAndNews = () => {
    const [viewerIsOpen, setViewerIsOpen] = useState(false);
    const [currImg, setCurrImg] = useState(0);

    const images = [
        { src: 'https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/367004859_889793949383426_4433973487505866960_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=NDQvt2VsP5sAX_qWN-W&_nc_ht=scontent.fdac31-1.fna&oh=00_AfB_CEB-DAoGNKGX67fZJBbGd-fNk5Oc6hXOf9gdPJMllQ&oe=64DBAE46' },
        { src: 'https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366655060_889793976050090_7599885234110666012_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=m3pwgZyYQxIAX8m6vRJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfB8KBkj5S0ulfzK9S8OgWY8rQMjfDT8E5pNhHddmyD7lQ&oe=64DCDF2D' },
        { src: 'https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328' },
        // Add more images as needed
    ];

    const gotoPrevious = () => {
        setCurrImg(prevImg => prevImg - 1);
    };

    const gotoNext = () => {
        setCurrImg(prevImg => prevImg + 1);
    };

    const closeViewer = () => {
        setViewerIsOpen(false);
    };

    const openViewer = (index) => {
        setCurrImg(index);
        setViewerIsOpen(true);
    };

    return (
        <div className="max-w-[1120px] mx-auto mt-12 px-3 md:px-0">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                {images.map((image, index) => (
                    <img
                        key={index}
                        src={image.src}
                        alt={`Image ${index}`}
                        onClick={() => openViewer(index)}
                        className="cursor-pointer mb-4 md:mb-0"
                    />
                ))}
                <ImgsViewer
                    imgs={images}
                    currImg={currImg}
                    isOpen={viewerIsOpen}
                    onClickPrev={gotoPrevious}
                    onClickNext={gotoNext}
                    onClose={closeViewer}
                />
            </div>
            <div className='mt-12'>
                <Swiper
                    slidesPerView={1}
                    spaceBetween={10}
                    breakpoints={{
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                        1024: {
                            slidesPerView: 4,
                        },
                    }}
                    modules={[Pagination]}
                    className="mySwiper"
                >
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                    <SwiperSlide>
                        <img src="https://scontent.fdac31-1.fna.fbcdn.net/v/t39.30808-6/366973619_889796666049821_6402266277747436804_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7f8c78&_nc_ohc=nvYHZ5AIlKAAX87ZjHJ&_nc_ht=scontent.fdac31-1.fna&oh=00_AfDgveJu4na5jWqxAdNZQERomK7Xj3Nk3OvjqkPuqfjdFA&oe=64DC5328" alt="" />
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    );
};

export default AwardAndNews;
