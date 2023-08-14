import { baseUrl } from "../../Helper/Config";
import UseProducts from "../../hooks/UseProducts";

const BookPrice = () => {
    const [data] = UseProducts();

    return (
        <div className="max-w-[1120px] mx-auto mt-12 text-center">

            <div className="my-5">
                <img className="mx-auto" src={baseUrl+data?.details?.review_images} alt="" />
            </div>

            <div className="border-b border-black py-2">
                <h1 className="text2 text-4xl font-bold"> {data?.data?.title}</h1>
            </div>

            <div className=" flex justify-around text-xl sm:text-2xl mt-5">
                <p className="font-bold text-[#163C62]">সাধারণ মূল্য</p>
                {data?.data?.offer_price > 0 ?  <p className="text-[#FF0000] font-bold"><del>{data?.data?.price} টাকা</del></p> : <p>{data?.data?.price} টাকা</p> }
            </div>
            <div className="flex justify-around mt-12">
                <p className="font-bold text-[#163C62] text-xl sm:text-2xl">অফার মূল্য</p>
                <p className="text-2xl sm:text-3xl">{data?.data?.offer_price} টাকা</p>
            </div>

            <div className="text-center text-xl sm:text-2xl mt-12">
                <p className="font-bold">{data?.details?.motive_title}</p>
            </div>
        </div>

    );
};

export default BookPrice;