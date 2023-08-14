import { useState } from "react";
import { FaChevronDown, FaChevronUp } from "react-icons/fa";
import UseProducts from "../../hooks/UseProducts";

const CommonQuestion = () => {
    const [data] = UseProducts()
    const [activeIndex, setActiveIndex] = useState(null);

    const questions = data?.QuationAns;

    const toggleAccordion = (index) => {
        setActiveIndex(activeIndex === index ? null : index);
    };

    if (questions) {
        return (
            <div className="max-w-[1120px] mx-auto mt-12">
                <div className="max-w-3xl mx-auto">
                    <div className="border-b border-black py-4 text-center">
                        <h1 className="text-4xl">কিছু সাধারণ প্রশ্নের উত্তর</h1>
                    </div>

                    {
                        data ? (<div className="space-y-4 mt-10">
                            {questions.map((item, index) => (
                                <div
                                    key={index}
                                    className={`bg-white shadow-lg p-4 rounded-lg ${activeIndex === index
                                        ? 'mb-4 transition-all duration-1000 ease-out'
                                        : 'mb-2 transition-all duration-1000 ease-in'
                                        }`}
                                >
                                    <button
                                        className="flex justify-between items-center w-full focus:outline-none"
                                        onClick={() => toggleAccordion(index)}
                                    >
                                        <h3
                                            className={`text-lg font-medium ${activeIndex === index ? 'text-green-600' : 'text-black'
                                                }`}
                                        >
                                            {item.quotaion}
                                        </h3>
                                        {activeIndex === index ? (
                                            <FaChevronUp className="w-4 h-4 text-gray-600" />
                                        ) : (
                                            <FaChevronDown className="w-4 h-4 text-gray-600" />
                                        )}
                                    </button>
                                    {activeIndex === index && (
                                        <p className="mt-2 text-gray-700">{item.ans}</p>
                                    )}
                                </div>
                            ))}
                        </div>) : (<p>Loading data...</p>)
                    }
                </div>


            </div>
        );
    }else{
        return (
            <></>
        );
    }
};

export default CommonQuestion;