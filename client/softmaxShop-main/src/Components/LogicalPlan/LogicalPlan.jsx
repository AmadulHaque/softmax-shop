import { useEffect, useState } from "react";
import { FaHandPointRight } from "react-icons/fa";
import UseProducts from "../../hooks/UseProducts";
import { baseUrl2 } from "../../Helper/Config";
import { Link as ScrollLink } from "react-scroll";

const LogicalPlan = () => {
    const [data] = UseProducts();
    const [video,setVideo] = useState();

    useEffect(()=>{
        const videoId = data?.details?.video_two_url?.split('/').pop(); 
        setVideo(videoId)
    },[data?.details])
    

    if (data?.details?.PD_image_one && data?.details?.PD_image_two) {
        return (
            <div className="max-w-[1120px] mx-auto">
                <div className="flex flex-col md:flex-row gap-5 justify-center">
                    <div className="bg-white p-4 rounded-lg shadow-lg flex items-center justify-center">
                        <img src={baseUrl2 + data?.details?.PD_image_one} alt="Image 1" className="max-h-[800px] w-auto" />
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow-lg flex items-center justify-center">
                        <img src={baseUrl2 + data?.details?.PD_image_two} alt="Image 2" className="max-h-[800px] w-auto" />
                    </div>
                </div>

                <div className="text-center my-5">
                    <div
                        className="inline-block"
                        style={{
                            border: '1px solid black', // Outer border
                            padding: '2px', // Adjust as needed
                            background: 'white', // Adjust as needed
                        }}
                    >
                        <div
                            style={{
                                border: '1px double black', // Inner double border
                                padding: '10px', // Adjust as needed
                            }}
                        >
                            <h1 className="text-2xl">{data?.details?.video_two_title}</h1>
                        </div>
                    </div>
                </div>

                <div className="max-w-[1120px] mx-auto px-2 sm:px-0 my-5">
                    <iframe
                        className="w-full h-[315px] sm:h-[400px] md:h-[575px] border-4 border-blue-500"
                        src={`https://www.youtube.com/embed/${video}`}
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowFullScreen
                    ></iframe>
                </div>

                <div className="text-center space-y-4">
                    <p className=" text2 text-red-600">{data?.details?.video_desc}</p>

                    <div className="flex justify-center">
                        <ScrollLink to="payment">
                            <button className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md text-xl sm:text-2xl flex items-center space-x-2">
                                <FaHandPointRight />
                                <span>Order Now</span>
                            </button>
                        </ScrollLink>
                    </div>
                </div>

                <div className="mt-10">
                    <p className="font-bold text2 p-5 border-2 border-black text-center">{data?.details?.review_desc}</p>

                    <div className="max-w-[1120px] mx-auto px-2 sm:px-0 my-5">
                        <iframe
                            className="w-full h-[315px] sm:h-[400px] md:h-[575px] border-4 border-blue-500"
                            src="https://www.youtube.com/embed/pQgEwXicmmM"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowFullScreen
                        ></iframe>
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

export default LogicalPlan;