import React, { useEffect, useState } from 'react';
import { baseUrl,baseUrl2 } from '../Helper/Config';
import { FaHandPointRight } from "react-icons/fa";
import axios from 'axios';
import { Link } from 'react-router-dom';

import civil from "../assets/book/সিভিল ২য় পর্ব-01-min.jpg"; 
import electronics from "../assets/book/ইলেকট্রনিক্স ৪-01-min.jpg";
import Electrical  from "../assets/book/ইলেকট্রিক্যাল ৩-01-min.jpg";
import Mechanical  from "../assets/book/মেকানিক্যাল-01-min.jpg";
import Computer  from "../assets/book/কম্পিউটার ২-02-min.jpg";
import Power  from "../assets/book/পাওয়ার-01-min.jpg";
import Footer from "../Components/Footer/Footer"


const Home = () => {

    const [products,setProduct ] =useState([]);

 
    useEffect(()=>{
        axios.get(baseUrl+'/products').then((res)=>{
            setProduct(res?.data?.data)
        }).catch((err)=>{
        })
    },[])

    return (
      <>
      <div className="">
        <div className="bg-[#56178608] py-5 mt-12">
          <div className="max-w-[1120px] mx-auto text-center px-10">
            <div className="border-b border-black py-2">
              <h2 className="text2">
              আজই  সফটম্যাক্স স্মার্ট বুক  কিনতে নিচের কিনুন বাটনে ক্লিক করুন ।
              </h2>
            </div>
           
            <div className="grid md:grid-cols-3 gap-5 mt-[80px] relative ">
            {products?.map((info, i) => (
              <>
                <div  className='absolute text-center left-[40%] top-[-57px]' >
                    <Link  to={`/product/details?slug=${info.slug}`}>
                      <button className="bg-orange-500  hover:bg-orange-600 text-white font-semibold py-2 m-auto px-4 rounded-md text-xl sm:text-2xl flex items-center space-x-2">
                          <FaHandPointRight />
                          <span>কিনুন</span>
                      </button>
                    </Link>
                </div>
          
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <Link  to={`/product/details?slug=${info.slug}`}>
                    <img src={civil} alt="" />
                  </Link>
                </div>
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <Link  to={`/product/details?slug=${info.slug}`}>
                    <img src={Electrical} alt="" />
                  </Link>
                </div>
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <Link  to={`/product/details?slug=${info.slug}`}>
                  <img src={Mechanical} alt="" />
                  </Link>
                </div>
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <Link  to={`/product/details?slug=${info.slug}`}>
                  <img src={Computer } alt="" />
                  </Link>
                </div>
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <Link  to={`/product/details?slug=${info.slug}`}>
                  <img src={electronics} alt="" />
                  </Link>
                </div>
                <div className="bg-white p-1 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <Link  to={`/product/details?slug=${info.slug}`}>
                    <img src={Power} alt="" />
                  </Link>
                </div>
              </>
            ))}

            </div>
          </div>
        </div>
      </div>
      <Footer></Footer>
      </>
    );
};

export default Home;