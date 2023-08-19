import { useEffect, useState } from "react";
import { FaHandPointRight } from "react-icons/fa";
import UseProducts from "../../hooks/UseProducts";
import { Link as ScrollLink } from "react-scroll";

const Heading = () => {
    const [data] = UseProducts();

    const [video,setVideo] = useState();

    useEffect(()=>{
        const videoId = data?.details?.video_one_url?.split('/').pop(); 
        setVideo(videoId)
    },[data?.details])

    if (data?.details?.title) {
        return (
            <div className="max-w-[1120px] mx-auto">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center text-[#163C62]">
                        <h1 className="text-3xl sm:text-4xl md:text-5xl mb-2 text1 sm:mb-4 md:mb-5">{data?.details?.title}</h1>
                        <p className="text-xl sm:text-2xl text-two md:text-2xl">{data?.details?.sub_title}</p>
                    </div>

                    <div className="max-w-[1120px] mx-auto px-2 sm:px-0 my-5">
                        <iframe
                            className=" video w-full h-[315px] sm:h-[400px] md:h-[575px] border-4 border-blue-500"
                            src={`https://www.youtube.com/embed/${video}?autoplay=1`}
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture web-share"
                            allowFullScreen
                        ></iframe>
                    </div>
                    
                    <div className="text-center space-y-4">
                        <h1 className="text-xl sm:text-2xl md:text-3xl text-two font-bold"><span className="text-[#F66300]">⇑</span> বিস্তারিত জানতে ভিডিওটি দেখুন <span className="text-[#F66300]">⇑</span> </h1>
                        <div className="flex justify-center">
                            <ScrollLink to='payment'>
                                <button className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md text-xl sm:text-2xl flex items-center space-x-2">
                                    <FaHandPointRight />
                                    <span>Order Now</span>
                                </button>
                            </ScrollLink>
                        </div>
                    </div>


                </div>
            </div>

        );
    }else{
        return (
            <></>
        );
    }
};

export default Heading;