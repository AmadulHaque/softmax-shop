import React from 'react';
import BookPrice from "../Components/BookPrice/BookPrice"
import CommonQuestion from "../Components/CommonQuestion/CommonQuestion"
import Footer from "../Components/Footer/Footer"
import Heading from "../Components/Heading/Heading"
import LogicalPlan from "../Components/LogicalPlan/LogicalPlan"
import NeedToKnow from "../Components/NeddToKnow/NeedToKnow"
import Payment from "../Components/Payment/Payment"
import WhatWillLearn from "../Components/WhatWillLearn/WhatWillLearn"

const ProductDetails = () => {
    return (
        <div>
            <Heading></Heading>
            <NeedToKnow></NeedToKnow>
            <WhatWillLearn></WhatWillLearn>
            <LogicalPlan></LogicalPlan>
            <BookPrice></BookPrice>
            <Payment></Payment>
            <CommonQuestion></CommonQuestion>
            <Footer></Footer>
        </div>
    );
};

export default ProductDetails;