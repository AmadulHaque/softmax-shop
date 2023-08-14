import React, { useEffect, useState } from 'react';
import { baseUrl,baseUrl2 } from '../Helper/Config';
import { FaHandPointRight } from "react-icons/fa";
import axios from 'axios';
import { Link } from 'react-router-dom';

const Home = () => {

    const [products,setProduct ] =useState([]);

 
    useEffect(()=>{
        axios.get(baseUrl+'/products').then((res)=>{
            setProduct(res?.data?.data)
        }).catch((err)=>{
        })
    },[])

    return (
        <div classname="">
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
                <div className='absolute text-center left-[40%] top-[-57px]' >
                    <Link  to={`/product/details?slug=${info.slug}`}>
                      <button className="bg-orange-500  hover:bg-orange-600 text-white font-semibold py-2 m-auto px-4 rounded-md text-xl sm:text-2xl flex items-center space-x-2">
                          <FaHandPointRight />
                          <span>কিনুন</span>
                      </button>
                    </Link>
                </div>
          
                
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/সিভিল ২য় পর্ব-01.jpg'} alt="" />
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/ইলেকট্রিক্যাল ৩-01.jpg'} alt="" />
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/মেকানিক্যাল-01.jpg'} alt="" />
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/কম্পিউটার ২-02.jpg'} alt="" />
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/ইলেকট্রনিক্স ৪-01.jpg'} alt="" />
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                  <img src={baseUrl2 +'images/book/পাওয়ার-01.jpg'} alt="" />
                </div>
              </>
            ))}

            </div>
          </div>
        </div>
      </div>
      
    );
};

export default Home;