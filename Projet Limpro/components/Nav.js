import * as React from 'react';
import {
    createDrawerNavigator,
    DrawerContentScrollView,
    DrawerItemList,
    DrawerItem, useDrawerProgress, DrawerToggleButton,
} from '@react-navigation/drawer';
import Home from './Home';
import Animated from "react-native-reanimated";
import Game from './Game';
import Basic_choice from './Basic_choice';
import Format_choice from './Format_choice';
import {createNativeStackNavigator} from "@react-navigation/native-stack";
import Personalization from "./Personalization";
import {Image, StyleSheet, TouchableOpacity, View} from "react-native";
import * as Font from 'expo-font';
import {useState} from "react";
import Apploading from "expo-app-loading";
import basic_choice from "./Basic_choice";
import {LinearGradient} from 'expo-linear-gradient';
import {NavigationActions as navigation} from "react-navigation";
import {useNavigation} from "@react-navigation/native";

const getFonts = () =>
    Font.loadAsync({
        PoppinsMedium: require("../assets/fonts/Poppins-Medium.ttf"),
    });

function CustomDrawerContent(props) {
    const [fontsloaded, setFontsLoaded] = useState(false);
    const progress = useDrawerProgress();

    const translateX = Animated.interpolateNode(progress, {
        inputRange: [0, 1],
        outputRange: [-100, 0],
    });
    if (fontsloaded) {
        return (
            <DrawerContentScrollView {...props} style={{backgroundColor: '#926593'}}>
                <Animated.View style={{transform: [{translateX}]}}>
                    <DrawerItem labelStyle={styles.label} label="Enregistrements"
                                onPress={() => alert('Link to help')}/>
                    <DrawerItem labelStyle={styles.label} label="Favoris" onPress={() => alert('Link to help')}/>
                    <DrawerItem labelStyle={styles.label} label="Paramètres" onPress={() => alert('Link to help')}/>
                </Animated.View>
            </DrawerContentScrollView>
        );
    } else {
        return (
            <Apploading
                startAsync={getFonts}
                onFinish={() => {
                    setFontsLoaded(true);
                }}
                onError={console.warn}
            />
        );
    }
}

const Drawer = createDrawerNavigator();
const Stack = createNativeStackNavigator();

function DrawerNav() {
    const navigation = useNavigation();
    return (
        <View style={styles.container}>
            <Drawer.Navigator
                useLegacyImplementation
                drawerContent={(props) => <CustomDrawerContent {...props} />}
                screenOptions={{
                    headerStyle: {
                        backgroundColor: '#380D39',
                        elevation: 0, //ANDROID
                        shadowOpacity: 0, //IOS
                        borderBottomWidth: 0, //IOS
                    },
                    headerLeft: false,
                    drawerPosition: "right",
                    headerRight: () => <DrawerToggleButton/>,
                }}
            >
                <Drawer.Screen name=" " component={Home} options={{

                }}/>
                <Drawer.Screen name="  " component={Format_choice} options={{
                    headerLeft: () => (
                        <TouchableOpacity onPress={() => navigation.goBack()}>
                            <Image
                                source={require('../assets/LOGO_LIMPRO_jaune.png')}
                                style={{width: 42.5, height: 39, marginLeft: 16, marginBottom: 8, resizeMode:'contain'}}
                            />
                        </TouchableOpacity>
                    ),
                }}/>
                <Drawer.Screen name="   " component={basic_choice} options={{
                    headerLeft: () => (
                        <TouchableOpacity onPress={() => navigation.goBack()}>
                            <Image
                                source={require('../assets/LOGO_LIMPRO_jaune.png')}
                                style={{width: 42.5, height: 39, marginLeft: 16, marginBottom: 8, resizeMode:'contain'}}
                            />
                        </TouchableOpacity>
                    ),
                }}/>
                <Drawer.Screen name="    " component={Personalization} options={{
                    headerLeft: () => (
                        <TouchableOpacity onPress={() => navigation.goBack()}>
                            <Image
                                source={require('../assets/LOGO_LIMPRO_jaune.png')}
                                style={{width: 42.5, height: 39, marginLeft: 16, marginBottom: 8, resizeMode:'contain'}}
                            />
                        </TouchableOpacity>
                    ),
                }}/>
            </Drawer.Navigator>
        </View>
    );
}

function MyDrawer() {
    return (
        <View style={styles.container}>
            <Stack.Navigator>
                <Stack.Group>
                    <Stack.Screen name="Root" component={DrawerNav} options={{headerShown: false}}/>
                    <Stack.Screen name="Home" component={Home} options={{headerShown: false}}/>
                    <Stack.Screen name="  " component={Format_choice} options={{headerShown: false}}/>
                    <Stack.Screen name="   " component={Basic_choice} options={{headerShown: false}}/>
                    <Stack.Screen name="    " component={Personalization} options={{headerShown: false}}/>
                    <Stack.Screen name="     " component={Game} options={{headerShown: false}}/>
                </Stack.Group>
            </Stack.Navigator>
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#3F0F40'
    },
    label: {
        color: '#340335',
        fontSize: 18,
        fontWeight: 'bold',
        fontFamily: 'PoppinsMedium',
    },
    background: {
        position: 'absolute',
        left: 0,
        right: 0,
        top: 0,
        height: 900,
    },
});

export default MyDrawer
