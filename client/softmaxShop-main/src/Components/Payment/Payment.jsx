import React, { useState ,useEffect } from 'react';
import toast, { Toaster } from 'react-hot-toast';
import { FaCheckCircle, FaFacebook } from "react-icons/fa";
import { Link } from "react-router-dom";
import UseProducts from "../../hooks/UseProducts";
import { baseUrl2 } from '../../Helper/Config';
import { baseUrl } from '../../Helper/Config';
import axios from 'axios';

const Payment = () => {

    const [data] = UseProducts(); 


    const [state, setState] = useState({
        product_id :data?.data?.id,
        name : "",
        email : "",
        phone : "",
        address : "",
        ship_postal_code : "",
        discount : 0,
        department : "",
        semester : ""
    });

    useEffect(()=>{
        setState(prevState => ({
            ...prevState,
            product_id:data?.data?.id
        }));
    },[data])

    const inputHandle = (e) => {
        setState({
            ...state,
            [e.target.name]: e.target.value
        });
    };

    const add = async  (e) =>  {
        e.preventDefault();
 
        if(state.product_id==""){
           toast.error('Product Required!');
        }
        if(state.name==""){
           toast.error('Name Required!');
        }
        else if(state.phone==""){
           toast.error('Phone Required!');
        }
        else if(state.email==""){
           toast.error('Email Required!');
        }
        else if(state.address==""){
           toast.error('Address Required!');
        }
        else if(state.ship_postal_code==""){
           toast.error('Postal Code Required!');
        }
        else if(state.department==""){
            toast.error('Department Required!');
        }
        else if(state.semester==""){
            toast.error('Semester Required!');
        }
        else {
            try {
                toast.success('Success!');
                const response = await axios.post(baseUrl+'/payment', state);
                window.location.href = response.data.data;
                // window.open(response.data.data, '_blank');
            } catch (error) {
                toast.error('Something Went Wrong!');
            }
        }
    };

    return (
        <div className="max-w-[1120px] mx-auto mt-12 p-3 md:p-0" id="payment">
            <Toaster />
            <div className="text-3xl text-center">
                <p className='text-[#FF0000] font-bold' >কিভাবে অর্ডার করবেন তা জানতে নিচের ভিডিওটি দেখুন</p>
            </div>
            <div className="max-w-[1120px] mx-auto px-2 sm:px-0 my-5">
                <iframe
                    className="w-full h-[315px] sm:h-[400px] md:h-[575px] border-4 border-blue-500"
                    src="https://www.youtube.com/embed/pQgEwXicmmM"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowFullScreen
                ></iframe>
            </div>

            <form onSubmit={add} className="w-full mx-auto">
                <h3 className="text-xl font-bold mb-5">Billing details</h3>
                <div className="mb-4">
                    <label htmlFor="fullName" className="block font-medium mb-1">Full Name *</label>
                    <input type="text" id="name" name='name' onChange={inputHandle} value={state.name} placeholder="name" className={`border rounded w-full py-2 px-3 border-gray-300`} />
                </div>

                <div className="mb-4">
                    <label htmlFor="phone" className="block font-medium mb-1">Phone *</label>
                    <input type="text" id="phone" name='phone' onChange={inputHandle} value={state.phone} className={`border rounded w-full py-2 px-3  border-gray-300`} />
                </div>

                <div className="mb-4">
                    <label htmlFor="email" className="block font-medium mb-1">Email address *</label>
                    <input type="email" id="email" name='email' onChange={inputHandle} value={state.email} className={`border rounded w-full py-2 px-3  border-gray-300`}/>
                </div>
                <h3 className="text-xl font-bold my-5">Additional information</h3>
                <div className="mb-4">
                    <label htmlFor="address" className="block font-medium mb-1">Address *</label>
                    <input type="text" id="address" name='address' onChange={inputHandle} value={state.address} className={`border rounded w-full py-2 px-3  border-gray-300`}/>
                </div>
                <div className="mb-4">
                    <label htmlFor="postCode" className="block font-medium mb-1">Post Code *</label>
                    <input type="text" id="postCode" name='ship_postal_code' onChange={inputHandle} value={state.ship_postal_code} className={`border rounded w-full py-2 px-3 border-gray-300`}/>
                </div>

                <div className="mb-4">
                    <label htmlFor="department" className="block font-medium mb-1">Select Department *</label>
                    <select id="department" name='department' onChange={inputHandle} value={state.department} className={`border rounded w-full py-2 px-3  border-gray-300`} >
                        <option value="">Select Department</option>
                        <option value="electrical">Electrical Technology</option>
                        <option value="mechanical">Mechanical Technology</option>
                        <option value="civil">Civil Technology</option>
                        <option value="computer">Computer Technology</option>
                        <option value="power">Power Technology</option>
                        <option value="electronics">Electronics Technology</option>
                        {/* Add more options here */}
                    </select>
                </div>

                <div className="mb-4">
                    <label htmlFor="semester" className="block font-medium mb-1">Select Semester *</label>
                    <select id="semester" name='semester' onChange={inputHandle} value={state.semester} className={`border rounded w-full py-2 px-3    border-gray-300`}>
                        <option value="">Select Semester</option>
                        <option value="semester1">1st Semester</option>
                        <option value="semester2">2nd Semester</option>
                        <option value="semester3">3rd Semester</option>
                        <option value="semester4">4th Semester</option>
                        <option value="semester5">5th Semester</option>
                        <option value="semester6">6th Semester</option>
                        <option value="semester7">7th Semester</option>
                        {/* Add more options here */}
                    </select>
                </div>
            
                <div className="mt-10">
                    <h3 className="text-xl font-bold mb-5">Your Order</h3>
                </div>
       
                <div>
                    <table className="border-collapse w-full">
                        <thead>
                            <tr className="border-b">
                                <th className="py-2 px-4 text-left font-semibold">Product</th>
                                <th className="py-2 px-4 text-right font-semibold">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr className="border-b">
                                <td className="py-2 px-4">
                                    <p className="font-semibold">
                                        <div className='block'>
                                            <img className='w-1/12 float-left' src={baseUrl2 + data?.data?.thumbnail} alt="" />
                                            <span className='w-8/12 pl-5 mt-4 float-left  justify-center align-items-center'>{data?.data?.id} {data?.data?.title}</span>
                                        </div>
                                    </p>
                                   
                                </td>
                                <td className="py-2 px-4 text-right"><span className='pr-3'>× 1</span> ৳ 199</td>
                            </tr>
                            <tr className="border-b">
                                <td className="py-2 px-4 font-semibold">Subtotal</td>
                                <td className="py-2 px-4 text-right">৳ 199</td>
                            </tr>
                            <tr>
                                <td className="py-2 px-4 font-semibold">Total</td>
                                <td className="py-2 px-4 text-right">৳ 199</td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" className="bg-[#F66300] hover:bg-[#f64e00] text-white font-semibold py-3 px-6 w-full rounded-lg flex items-center justify-center space-x-2 mt-5">
                        <span>Place Order</span>
                        <span><FaCheckCircle /></span>
                    </button>
                </div>
            </form>

            <div className="text-center space-y-5 mt-10">
                <p className="text-2xl">অর্ডার করতে কোন সমস্যা হলে ফেসবুক পেইজে ম্যাসেজ করুন</p>
                <Link
                    to="https://www.facebook.com/softmaxbd"
                    target="_blank"
                    className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md inline-flex items-center space-x-2"
                >
                    <FaFacebook />
                    <span>Facebook Page</span>
                </Link>
                <p>{ }</p>
            </div>

        </div>
    );
};

export default Payment;