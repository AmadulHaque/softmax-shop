import { FaHandPointRight, FaRegCheckSquare } from "react-icons/fa";
import UseProducts from "../../hooks/UseProducts";
import { Link as ScrollLink } from "react-scroll";

const NeedToKnow = () => {
    const [data] = UseProducts();
    const infos = data?.important;

    if (data?.details?.important_title) {
        return (
            <div className="max-w-[1120px] mx-auto">
                <div className="mt-12 text-center">
                    <div className="border-b border-black py-2">
                        <h1 className="text-4xl text-one ">{data?.details?.important_title}</h1>
                    </div>

                    <div className="mt-5 flex justify-center">
                        {
                            data ? (<div className="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                                {
                                    infos.map((info, i) => (
                                        <div
                                            key={i}
                                            className="flex items-center space-x-2 md:flex-col md:items-center md:space-y-4">
                                            <FaRegCheckSquare className="md:text-[#F66300] text-green-500 text-2xl" />
                                            <p className="md:text-lg font-bold text">{info.title}</p>
                                        </div>
                                    ))
                                }
                            </div>) : (<p>Loading data...</p>)
                        }
                    </div>

                    <div className="text-center space-y-10 mt-12">
                        <div className="flex justify-center">
                            <ScrollLink to="payment">
                                <button className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md text-xl sm:text-2xl flex items-center space-x-2">
                                    <FaHandPointRight />
                                    <span>Order Now</span>
                                </button>
                            </ScrollLink>
                        </div>

                        <p className="text2">{data?.details?.important_desc}</p>
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

export default NeedToKnow;