import { FaEnvelope, FaFileContract, FaLock, FaMapMarkerAlt } from "react-icons/fa";

const Footer = () => {
    return (
        <div className="bg-black text-white mt-12 py-16">
            <div className="max-w-[1120px] mx-auto space-y-10 px-4 sm:px-6">
                <div className="flex flex-col sm:flex-row justify-between items-center mb-8 sm:mb-0">
                    <div className="mb-4 sm:mb-0 space-y-5 text-center sm:text-left">
                        <p className="flex items-center">
                            <FaMapMarkerAlt className="w-4 h-4 mr-2 text-gray-300" />
                            Haque Villa, Rangamati Nir, DUET, Gazipur-1707
                        </p>
                        <p className="flex items-center">
                            <FaEnvelope className="w-4 h-4 mr-2 text-gray-300" />
                            sosbd24@gmail.com
                        </p>
                    </div>
                    <div className="space-y-5 text-center sm:text-right">
                        <a href="#" className="flex items-center text-gray-300 hover:text-white">
                            <FaLock className="w-4 h-4 mr-1" />
                            <span>Privacy Policy</span>
                        </a>
                        <a href="#" className="flex items-center text-gray-300 hover:text-white">
                            <FaFileContract className="w-4 h-4 mr-1" />
                            <span>Terms & Conditions</span>
                        </a>
                    </div>
                </div>
                <div className="text-center">
                    <p>© 2023 Softmax Shop Ltd. All Rights Reserved.</p>
                </div>
            </div>
        </div>

    );
};

export default Footer;