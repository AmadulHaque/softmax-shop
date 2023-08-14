import { FaCheckCircle } from "react-icons/fa";
import UseProducts from "../../hooks/UseProducts";

const WhatWillLearn = () => {
    const [data,] = UseProducts();
    
    const infos = data?.PdLearn;

    if (data?.details?.PD_learn_title) {
        return (
            <div className="bg-[#56178608] py-5 mt-12">
                <div className="max-w-[1120px] mx-auto text-center px-10">
                    <div className="border-b border-black py-2">
                        <h2 className=" text-one">{data?.details?.PD_learn_title}</h2>
                    </div>
                    {data ? (
                        <div className="grid md:grid-cols-3 gap-5 mt-8">
                            {infos?.map((info, i) => (
                                <div
                                    key={i}
                                    className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center"
                                >
                                    <FaCheckCircle className="text-[#F66300] mb-3 text-4xl" />
                                    <p className=" text font-bold  md:text-lg">{info.title}</p>
                                    <p className="text2 md:text-sm">{info.desc}</p>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p>Loading data...</p>
                    )}
                    <div className="text-center space-y-5 mt-12">
                        <h1 className="text-4xl text-red-600">{data?.gift?.title}</h1>
                        <p className="text2 font-bold">{data?.gift?.desc}</p>
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

export default WhatWillLearn;
